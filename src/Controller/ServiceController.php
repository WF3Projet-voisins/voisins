<?php

namespace App\Controller;



use App\Entity\Comment;

use App\Entity\Service;
use App\Form\CommentType;
use App\Form\ServiceType;
use App\Service\FormsManager;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Repository\ServiceRepository;
use App\Repository\CategoryRepository;
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
            return $this->redirectToRoute('serviceGet');
        }



        return $this->render('user/addService.html.twig', ["formService" => $formService->createView()]);
    }



    public function getServiceAction(Request $request, ServiceRepository $serviceRepository, UserRepository $userRepository)
    {

        $services = $serviceRepository->findAll();
        $users = $userRepository->findAll();

        //je redirige vers la route de mon choix 
        foreach ($users as $user) {
            return $this->render('service/pageService.html.twig', [

                'controller_name' => 'ServiceController', 'services' => $services, 'user' => $user
            ]);
        }
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


    

    public function getServiceByType()
    {
        /* pour afficher sur la page serviceS les services en fonction des types giveService/needService  */
        return $this->render('service/services.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }
}
