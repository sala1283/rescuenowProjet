<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        //$article = new Article();
        //$article
        //->setTitle('Mon Premier Article')
        //->setDescription('Premier artcile test');
        //$em = $this->getDoctrine()->getManager();
        //$em->persist($article);
        //$em->flush();
        return $this->render('home/index.html.twig');
    }
}
