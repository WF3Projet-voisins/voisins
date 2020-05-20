<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Form\ContactType;
use App\Entity\Contact;
use App\Entity\Service;
use App\Repository\ServiceRepository;
use DateTimeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Validator\Constraints\DateTime;



class ServiceController extends AbstractController
{
    public function addServiceAction()
    {
        return $this->render('service/pageService.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    public function getServicesAction(Request $request, ServiceRepository $serviceRepository){
        
        $services = $serviceRepository->findAll();

            
            //je redirige vers la route de mon choix 
        return $this->render('service/pageService.html.twig', [

            'controller_name' => 'ServiceController', 'services' => $services,   
        ]);

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
