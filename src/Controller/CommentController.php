<?php

namespace App\Controller;



use App\Entity\Comment;

use Symfony\Component\HttpFoundation\Response;
use App\Repository\CommentRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CommentController extends AbstractController
{
    public function deleteCommentaireAction(UserInterface $user, Request $request, CommentRepository $commentRepository, $id)
    {
        $comment = $commentRepository->find($id);
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($comment);
        $manager->flush();


        $response = new Response(
            "",
            Response::HTTP_OK,
            ['content-type' => 'text/html']
        );

        return $response;
    }
}
