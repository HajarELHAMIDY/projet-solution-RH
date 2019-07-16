<?php

namespace App\Controller\frontEnd;


use App\Entity\Job;
use App\Form\backoffice\JobType;
use App\Entity\Application;
use App\Form\frontoffice\ApplicationFront;
use Symfony\component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\component\HttpFoundation\Session\Flash\FlashBagInterface;

class HomePageController extends AbstractController
{

  
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        
        $repository = $this->getDoctrine()->getRepository(Job::class);
       
        $job = $repository->findBy([]
           , ['create_at' => 'DESC'],3,0
        ); 

        return $this->render('/frontoffice/home.html.twig', 
           ['jobs' => $job]
        );

    }
}