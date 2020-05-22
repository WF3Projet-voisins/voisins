<?php

namespace App\Controller;



use App\Entity\Service;

use App\Form\ServiceType;
use App\Service\FormsManager;
use App\Repository\UserRepository;
use App\Repository\ServiceRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




class ServiceController extends AbstractController
{
    public function addServiceAction(Request $request, ServiceRepository $serviceRepository, CategoryRepository $categoryRepository, UserRepository $userRepository, $id)
    {
        
        /* Ajout d'un service par un user */
        $user = $userRepository->find($id);
        $service = new Service();
        $formService = $this->createForm(ServiceType::class, $service);
        $formService->handleRequest($request);

        if ($formService->isSubmitted())  {
            $service = $formService->getData();
            $file = $formService->get('image')->getData();
            if ($file) {
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $service->setImage($newFileName);
            }
            $service->setCreatedAt(new \DateTime());
            $service->setStatus('En cours');
            $service->setUser($user);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($service);
            $manager->flush();
            return $this->redirectToRoute('index');
        }
        


        return $this->render('user/addService.html.twig', ["formService" => $formService->createView()]);
    }



    public function getServiceAction(Request $request, ServiceRepository $serviceRepository)
    {

        $services = $serviceRepository->findAll();


        //je redirige vers la route de mon choix 
        return $this->render('service/pageService.html.twig', [

            'controller_name' => 'ServiceController', 'services' => $services,
        ]);
    }


    public function getServicebyIdAction(Request $request, ServiceRepository $serviceRepository, $id){
        $service = $serviceRepository->find($id);
        return $this->render('service/pageOneService.html.twig', ['service' => $service]);
  
    }







    public function updateServiceAction()
    {
        return $this->render('service/pageService.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    public function deleteServiceAction()
    {
        return $this->render('service/pageService.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    public function addCommentaireAction()
    {
        /* ajout d'un commentaire sur la page service */
        return $this->render('service/pageService.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    public function getCommentaireAction()
    {
        /* récupère les commentaires pour afficher sur la page service */
        return $this->render('service/pageService.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    public function updateCommentaireAction()
    {
        /* récupère les commentaires pour afficher sur la page service */
        return $this->render('service/pageService.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    public function deleteCommentaireAction()
    {
        /* si user veut delete ses commentaires sur la page service */
        return $this->render('service/pageService.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    public function getServiceByType()
    {
        /* pour afficher sur la page serviceS les services en fonction des types giveService/needService  */
        return $this->render('service/services.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }
}
