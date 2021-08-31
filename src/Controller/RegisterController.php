<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Classe\Mail;

class RegisterController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $notification = null;
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());
            if (!$search_email) {
                $password = $encoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
                $mail = new Mail();
                $content = "Bonjour " . $user->getFirstname();
                $mail->send($user->getEmail(), $user->getFirstname(), "Bienvenue sur note site", $content);
                $notification = "Votre inscription s'est correctement déroulée. Vous pouvez dés à présent vous connectez à votre compte.";
            } else {
                $notification = "L'émail que vous avez renseigné existe déja.";
            }
        }
        return $this->render('register/index.html.twig', ['form' => $form->createView(), 'notification' => $notification]);
    }
}
