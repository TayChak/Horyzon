<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{   
    /** 
     * @Route("/", name="homepage")
     * @param ArticleRepository $repo
     * 
     * @return Response
     */
    public function home(ArticleRepository $repo): Response
    {
        return $this->render('home.twig',
            [
                'articles' => $repo->findAll(),
            ]
        );
    }


    /** 
     * @Route("/article/{slug}", name="article_page")
     * @param Article $article
     * 
     * @return Response
     */
    public function show(Article $article): Response
    {
        return $this->render('show.twig',
            [
                'article' => $article
            ]
        );
    }



}
?>