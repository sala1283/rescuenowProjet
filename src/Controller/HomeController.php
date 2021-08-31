<?php

namespace App\Controller;


use App\Entity\Header;
use App\Entity\Service;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        $headers = $this->entityManager->getRepository(Header::class)->findAll();
        $servicesNew = $this->entityManager->getRepository(Service::class)->findByIsNew(1);
        $servicesPromo = $this->entityManager->getRepository(Service::class)->findByIsPromo(1);



        return $this->render('home/index.html.twig', ['headers' => $headers, 'servicesNew' => $servicesNew, 'servicesPromo' => $servicesPromo]);
    }
}
