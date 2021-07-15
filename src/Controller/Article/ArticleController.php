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

    /**
     * @Route ("/article/{id}", name = "article.show")
     */
    public function show(int $id)
    {

        $article = $this->repo->find($id);
        return $this->render('article/show.html.twig', ["article" => $article]);
    }
}
