<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service")
     */
    public function addServiceAction()
    {
        return $this->render('service/pageService.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    public function getServiceAction()
    {
        return $this->render('service/pageService.html.twig', [
            'controller_name' => 'ServiceController',
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
