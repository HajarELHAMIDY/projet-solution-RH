<?php

namespace App\Controller\frontEnd;


use App\Entity\Job;
use App\Form\backoffice\JobType;
use App\Entity\Application;
use App\Entity\User;
use App\Form\frontoffice\AppFront;
use Symfony\component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\component\HttpFoundation\Session\Flash\FlashBagInterface;


class JobController extends AbstractController
{

  
    /**
     * @Route("/jobs", name="jobs_index")
     */
    public function index_job()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $jobs = $entityManager->getRepository(Job::class)->findAll();

        return $this->render('/frontoffice/display_job.html.twig', [
            'jobs' => $jobs
            
        ]);
    }
    /**
     * @Route("/jobs/{id}",  name="detail_job")
     */
    public function job_detail($id,Request $request)
    {   
        //job's detail
        $repository = $this->getDoctrine()->getRepository(Job::class);
        $job = $repository->find($id);
        
        //formulaire 
        $application = new Application();
        $application->setJob($job);
        $form = $this->createForm(AppFront::class, $application);
        $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid())
        {   $file = $application->getCv();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('upload_directory'),$fileName);
            $application->setCv($fileName);
            $entityManager = $this->getDoctrine()->getManager();
        
            $entityManager->persist($application);
            $entityManager->flush();
          //  $this->addFlash('success','Bien envoyer avec success');
            return $this->redirectToRoute('jobs_index');
           
        } 

        return $this->render('/frontoffice/detail_job.html.twig',[
            'job'=>$job,
            'form' => $form->createView()

        ]);

}
}