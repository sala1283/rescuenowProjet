<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\User;
use App\Entity\ResetPassword;
use App\Form\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/mot-de-passe-oublier", name="reset_password")
     */
    public function index(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }
        if ($request->get('email')) {
            $user = $this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));
            if ($user) {
                $resetpassword = new ResetPassword();
                $resetpassword->setUser($user)
                    ->setToken(uniqid())
                    ->setCreatedAt(new \DateTime());

                $this->entityManager->persist($resetpassword);
                $this->entityManager->flush();

                $url = $this->generateUrl('update_password', ['token' => $resetpassword->getToken()]);
                $content = "Bonjour " . $user->getFirstname() . "<br/>Vous avez demandé à réinitialiser votre mot de passe.<br/><br/>";
                $content .= "Merci de bien vouloir cliquer sur le lien suivant pour <a href='" . $url . "'>Mettre à jour vore mot de passe</a>.";

                $mail = new Mail();
                $mail->send($user->getEmail(), $user->getFirstname() . '' . $user->getLastname(), 'réinitialiser votre mot de passe', $content);
                $this->addFlash('notice', 'Un lien pour réinitialiser votre mot de passe vous a été envoyé.');
            } else {
                $this->addFlash('notice', 'Cette adresse mail est introuvable.');
            }
        }
        return $this->render('reset_password/index.html.twig');
    }

    /**
     * @Route("/modifier-mot-de-passe/{token}", name="update_password")
     */

    public function update(Request $request, $token, UserPasswordEncoderInterface $encoder)
    {
        $reset_password = $this->entityManager->getRepository(ResetPassword::class)->findOneByToken($token);
        if (!$reset_password) {
            return $this->redirectToRoute('reset_password');
        }
        $now = new \DateTime();
        if ($now > $reset_password->getcreatedAt()->modify('+ 3 hour')) {
            $this->addFlash('notice', 'Votre demande de mot de passe a expiré. Merci de la renouveller.');
            return $this->redirectToRoute('reset_password');
        }
        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $new_pwd = $form->get('new_password')->getData();
            $password = $encoder->encodePassword($reset_password->getUser(), $new_pwd);
            $reset_password->getUser()->setPassword($password);
            $this->entityManager->flush();
            $this->addFlash('notice', 'Votre mot de passe a bien été mise à jour.');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('reset_password/update.html.twig', ['form' => $form->createView()]);
    }
}
