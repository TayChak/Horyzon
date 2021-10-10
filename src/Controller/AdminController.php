<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminController extends AbstractController
{   
    /** 
     * @Route("/admin", name="admin_page")
     * @param ArticleRepository $repo
     * 
     * @return Response
     */
    public function show(ArticleRepository $repo): Response
    {
        return $this->render('article/show.twig',
            [
                'articles' => $repo->getAllArticles(),
            ]
        );
    }

    /**
     * @Route("/admin/article/{id}/update", name="admin_article_update")
     *
     * @param Article $article
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function update(Article $article, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $manager->persist($article);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'article <strong>{$article->getTitle()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_page');
        }

        return $this->render('article/update.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/article/add", name="admin_article_add")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        {
            $article->setDate(new \DateTime(date('Y-m-d')));
            $manager->persist($article);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'article <strong>{$article->getTitle()}</strong> a bien été crée !"
            );

            return $this->redirectToRoute('admin_page');
        }

        return $this->render('article/new.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/article/{id}/delete", name="admin_article_delete")
     * 
     * @param Article $article
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Article $article, EntityManagerInterface $manager): Response
    {
        
        $manager->remove($article);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'article <strong>{$article->getTitle()}</strong> a bien été supprimée !"
        );
        
        return $this->redirectToRoute('admin_page');
    }

}
?>