<?php

namespace App\Controller\backEnd;


use App\Entity\Job;
use App\Form\backoffice\JobType;
use App\Entity\Application;
use App\Form\backoffice\ApplicationType;
use Symfony\component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\component\HttpFoundation\Session\Flash\FlashBagInterface;

class ApplicationController extends AbstractController
{
     /**
     * @Route("/admin/application", name="app_backend")
     */
    public function application_backend()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $app = $entityManager->getRepository(Application::class)->findAll();

        return $this->render('/backoffice/job/display_application.html.twig', [
            'application' => $app,
        ]);
    }

   


      
    /**
     * @Route("/admin/application/complete/{id}", name="app_complete")
     */
    
    public function complete(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $appFront = $entityManager->getRepository(Application::class)->findOneById($id);

        $form = $this->createForm(ApplicationType::class, $appFront);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
        
            $entityManager->persist($appFront);
            $entityManager->flush();
            $this->addFlash('success','Bien modifier avec success');
            return $this->redirectToRoute('app_backend');
           
        }   

        return $this->render(
            '/backoffice/job/add_application.html.twig',
            array('form' => $form->createView())
        );
    }
    
     /**
     * @Route("/admin/application/delete/{id}", name="app_delete")
     */
    public function delete(Request $request,$id){


        $entityManager = $this->getDoctrine()->getEntityManager();
        $app = $entityManager->getRepository(Application::class)->find($id);
        if($this->isCsrfTokenValid('delete' . $app->getId(), $request->get('_token'))){
            $entityManager->remove($app);
            $entityManager->flush();
            $this->addFlash('success','Bien supprimer avec success');
     
             return $this->redirectToRoute('app_backend');

        }
       
 
        }
  
}
?>
