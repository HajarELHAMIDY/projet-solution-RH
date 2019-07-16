<?php

namespace App\Controller\backEnd;


use App\Entity\Job;
use App\Entity\Statut;
use App\Form\backoffice\JobType;
use App\Form\backoffice\JobTypeEdit;
use App\Form\backoffice\UserType;
use App\Entity\Application;
use App\Form\backoffice\ApplicationType;
use Symfony\component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\component\HttpFoundation\Session\Flash\FlashBagInterface;

class JobController extends AbstractController
{

  
    /**
     * @Route("/admin/job", name="job")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $jobs = $entityManager->getRepository(Job::class)->findAll();

        return $this->render('/backoffice/job/display_job.html.twig', [
            'jobs' => $jobs,
        ]);
    }
   
   
    /**
     * @Route("/admin/job/add", name="job_add")
     */

    public function add(Request $request)

    {
        $job = new Job();
        $repository = $this->getDoctrine()->getRepository(Statut::class);
        $statut = $repository->find(2);
        
        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);
        $job->setStatut($statut);
      

        if ($form->isSubmitted() && $form->isValid())
        {   
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($job);
            $entityManager->flush();
            $this->addFlash('success','Bien ajouter avec success');
            return $this->redirectToRoute('job');
           
        }   

        return $this->render(
            '/backoffice/job/add_job.html.twig',
            array('form' => $form->createView())
        );
    }
    
    
    /**
     * @Route("/admin/job/edit/{id}", name="job_edit")
     */
    

    public function edit(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $job = $entityManager->getRepository(Job::class)->findOneById($id);

        $form = $this->createForm(JobTypeEdit::class, $job);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
        
            $entityManager->persist($job);
            $entityManager->flush();
            $this->addFlash('success','Bien modifier avec success');
            return $this->redirectToRoute('job');
           
        }   

        return $this->render(
            '/backoffice/job/add_job.html.twig',
            array('form' => $form->createView())
        );
    }

    
     /**
     * @Route("/admin/job/delete/{id}", name="job_delete")
     */
    public function delete(Request $request, $id){
        $i=0;

       $entityManager = $this->getDoctrine()->getEntityManager();
       $job = $entityManager->getRepository(Job::class)->find($id);
       $apps = $entityManager->getRepository(Application::class)->findAll();
       foreach($apps as $app){
           if($app->getJob()->getId()==$id){
               $i++;
           }
       }
       if($i==0){
        if($this->isCsrfTokenValid('delete' . $job->getId(), $request->get('_token'))){
            $entityManager->remove($job);
            $entityManager->flush();
            $this->addFlash('success','Bien supprimer avec success');
            return $this->redirectToRoute('job');
         }
          
  
      }
     else{
        $entityManager->flush();
        $this->addFlash('warning',"Vous n'avez pas le droit de supprimer cette offre ");
        return $this->redirectToRoute('job');
     }
      

       }
       
      
}
?>