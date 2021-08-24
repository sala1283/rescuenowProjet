<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InformatiqueController extends AbstractController
{
    /**
     * @Route("/informatique", name="informatique")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('informatique/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/category/{slug}", name="informatique.category")
     */
    public function categorie(Category $category, ServiceRepository $serviceRepository): Response
    {
        $services = $serviceRepository->findAllInformatique($category);
        return $this->render(
            'informatique/categorie.html.twig',
            ['category' => $category, 'services' => $services,]
        );
    }
}
