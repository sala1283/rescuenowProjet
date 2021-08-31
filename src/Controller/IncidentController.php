<?php

namespace App\Controller;

use DateTime;
use App\Entity\Incident;
use App\Form\IncidentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Classe\Mail;
use App\Notification\IncidentNotification;

class IncidentController extends AbstractController
{
    /**
     * @Route("/incident", name="incident")
     */
    public function index(Request $request, EntityManagerInterface $em, IncidentNotification $notification): Response
    {

        $incident = new Incident();
        $incident->setUser($this->getUser())
            ->setCreatedAt(new DateTime('Now'));
        $form = $this->createForm(IncidentType::class, $incident);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { {
                $notification->notifyIncident($incident);

                $this->addFlash('message', 'Votre ticket a bien été envoyé');
            }
            $em->persist($incident);
            $em->flush();
        }
        return $this->render('incident/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}
