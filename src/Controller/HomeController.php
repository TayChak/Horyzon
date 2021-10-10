<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{   
    /** 
     * @Route("/", name="homepage")
     * 
     * @return Response
     */
    public function home(): Response
    {
        return $this->render('home.twig',
            [
                //'users' => $userRepo->findBestUsers(2),
            ]
        );
    }

}
?>