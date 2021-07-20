<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElectroniqueController extends AbstractController
{
    /**
     * @Route("/electronique", name="electronique")
     */
    public function index(): Response
    {
        return $this->render('electronique/index.html.twig', [
            'controller_name' => 'ElectroniqueController',
        ]);
    }
}
