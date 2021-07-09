<?php

namespace App\Controller\Article;

use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    private ArticleRepository $repo;
    public function __construct(ArticleRepository $repo)
    {
        $this->repo = $repo;
    }
    /**
     * @Route("articles", name ="article.index")
     */
    public function index()
    {
        $articles = $this->repo->findAll();
        return $this->render('article/index.html.twig', ['articles' => $articles]);
    }
}
