<?php

namespace App\Controller\Article;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class ArticleController extends AbstractController
{


    private ArticleRepository $repo;
    private $entityManager;

    public function __construct(ArticleRepository $repo, EntityManagerInterface $entityManager)
    {
        $this->repo = $repo;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("articles", name ="article.index")
     */
    public function index()
    {
        $articles = $this->repo->findAll();
        return $this->render('article/index.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route ("/article/{slug}", name = "article.show")
     */
    public function show($slug)
    {

        $article = $this->entityManager->getRepository(Article::class)->findOneBySlug($slug);
        return $this->render('article/show.html.twig', ["article" => $article]);
    }
}
