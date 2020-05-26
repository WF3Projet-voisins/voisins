<?php

namespace App\Controller;



use App\Entity\Comment;

use App\Entity\Service;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\ServiceType;
use App\Service\FormsManager;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Repository\ServiceRepository;
use App\Repository\CategoryRepository;
use App\Repository\SubCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Security\Core\User\UserInterface;
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

        if ($formService->isSubmitted()) {
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
            $this->get('session')->getFlashBag()->add('Message', 'Service ajouté');
            return $this->redirectToRoute('dashboardUserService',['id'=> $id]);
        }



        return $this->render('user/addService.html.twig', ["user"=>$user,"formService" => $formService->createView()]);
    }



    public function getServiceAction(UserInterface $user, CategoryRepository $categoryRepository, Request $request, ServiceRepository $serviceRepository, UserRepository $userRepository)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
     
        $services = $serviceRepository->findAll();
       
        $categories = $categoryRepository->findAll();
        $users = $userRepository->findAll();

        $message = "";
        $link ="";
        

        $isUserServiceGlobal = false;

        foreach($services as $service){

            $isUserServiceGlobal = $this->getIsUserTownHasServices($service, $this->getUser());
        

        }
       
        
        if ($isUserServiceGlobal){
            $message =  "Il n'y a pas de services dans votre ville!";
            $link =      "Proposez un service pour votre entourage";

        }
        
            return $this->render('service/pageService.html.twig', [
              
                'controller_name' => 'ServiceController', 'services' => $services, 'categories' => $categories, 'user' => $user, 'message' => $message, 'link' => $link, 'messageAffichage' => $isUserServiceGlobal
            ]);
        
    }


    public function getServicebyIdAction(UserInterface $user, Request $request, ServiceRepository $serviceRepository, $id, UserRepository $userRepository, CommentRepository $commentRepository)
    {
        $service = $serviceRepository->find($id);
        
        $comments = $commentRepository->findBy(['service' => $service]);
        $newComment = new Comment();
        $formNewComment = $this->createForm(CommentType::class, $newComment);
        $formNewComment->handleRequest($request);

        if ($formNewComment->isSubmitted()) {
            $comment = $formNewComment->getData();
            $comment->setCreatedAt(new \DateTime());

            $comment->setUserFrom($user);
            $comment->setService($service);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($comment);
            $manager->flush();
            return $this->redirectToRoute('servicePage', ['id'=> $service->getId()]);
            
        }



        $users = $userRepository->findAll();
        foreach ($users as $user) {
            return $this->render('service/pageOneService.html.twig', ['service' => $service, 'user' => $user, 'comments' => $comments, 'formNewComment'=>$formNewComment->createView()]);
        }
    }


    public function dashboardServicesAction(UserInterface $user, UserRepository $userRepository){


        return $this->render('user/dashboardServiceUser.html.twig', ['user'=> $user, "servicesUser" => $user->getServices()]);
    }

    public function serviceModifyAction(UserInterface $user,Request $request,ServiceRepository $serviceRepository , UserRepository $userRepository, $id){

        $service = $serviceRepository->find($id);
        $formService = $this->createForm('App\Form\ServiceType', $service);
        $formService->handleRequest($request);

        if ($formService->isSubmitted()) {
            $service = $formService->getData();
            $file = $formService->get('image')->getData();
            if ($file) {
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $service->setImage($newFileName);
            }

            $manager = $this->getDoctrine()->getManager();


            $manager->persist($service);
            $manager->flush();
            $this->get('session')->getFlashBag()->add('Message', 'Service modifié');
            return $this->redirectToRoute('dashboardUserService', ['id' => $id]);
        }

        return $this->render('user/modifyServiceUser.html.twig', ['user'=> $user, "formService" => $formService->createView()]);

    }


    public function serviceDeleteAction(UserInterface $user,Request $request,ServiceRepository $serviceRepository , UserRepository $userRepository, $id){
        $service = $serviceRepository->find($id);
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($service);
        $manager->flush();
        $this->get('session')->getFlashBag()->add('Message', 'Service supprimé');
        return $this->redirectToRoute('dashboardUserService', ['id' => $user->getId()]);
    }

    private function getIsUserTownHasServices(Service $service, UserInterface $user): bool {
        $isUserTown = true;
        if($service->getUser()->getCity() === $user->getCity()){
            
            $isUserTown = false;
        }
        return $isUserTown;
    }
}
