<?php

namespace App\Controller\backEnd;


use App\Entity\Job;
use App\Form\backoffice\JobType;
use App\Entity\Application;
use App\Entity\User;
use App\Form\backoffice\ApplicationType;
use Symfony\component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\component\HttpFoundation\Session\Flash\FlashBagInterface;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $jobs = $entityManager->getRepository(Job::class)->findAll();
        $apps =  $entityManager->getRepository(Application::class)->findAll();
        $users = $entityManager->getRepository(User::class)->findAll();
        $j=0;
        $a=0;
        $u=0;
        foreach ($jobs as $job)         $j++;
        foreach ($apps as $app)         $a++;
        foreach ($users as $user)         $u++;
        return $this->render('/backoffice/job/first_page.html.twig', [
            'Nbr_job' => $j,
            'Nbr_app' => $a,
            'Nbr_user' => $u,
            
        ]);
      
    }

}