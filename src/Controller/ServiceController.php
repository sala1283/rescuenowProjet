<?php

namespace App\Controller;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class ServiceController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/nos-services", name="services")
     */
    public function index(): Response
    {
        $services = $this->entityManager->getRepository(Service::class)->findAll();
        return $this->render('service/index.html.twig', ['services' => $services]);
    }

    /**
     * @Route("/service/{slug}", name="service")
     */
    public function show($slug)
    {

        $service = $this->entityManager->getRepository(Service::class)->findOneBySlug($slug);
        return $this->render('service/show.html.twig', ['service' => $service]);
    }
}
