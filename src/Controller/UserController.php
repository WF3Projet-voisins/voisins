<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Ranking;
use App\Entity\SubCategory;
use App\Form\UserType;
use App\Entity\Invite;
use App\Repository\CategoryRepository;
use App\Repository\SubCategoryRepository;
use App\Service\FormsManager;
use App\Repository\UserRepository;
use App\Repository\RankingRepository;
use PhpParser\Node\Name;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints as Assert;





class UserController extends AbstractController
{
    
    public function addUserAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, RankingRepository $rankingRepository, CategoryRepository $categoryRepository, SubCategoryRepository $subCategoryRepository, UserRepository $userRepository)
    {
        
        $users = $userRepository->findAll();
        $ranking = $rankingRepository->findAll();
        $category = $categoryRepository->findAll();

        $subCategory = $subCategoryRepository->find('3');
        
        $form = null;
        // 1) build the form
        $newUser = new User();
        $form = $this->createForm(UserType::class, $newUser);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
       
        if ($form->isSubmitted()) {
            foreach($users as $user){ 
                if ($newUser->getEmail() === $user->getEmail() ){
                   
                    $this->addFlash('danger', 'L\'adresse mail existe déjà!');
                    return $this->redirectToRoute('userAdd');
                }                
                else {
                    foreach($ranking as $rank){
                        if ($rank->getName() === "Newbie" ){
                        $newUser->setRanking($rank);
                       }
                    
                    $newUser->setTimeGauge('0');
                    $newUser->setTotalTimeServiceGiven('0');
                    $newUser->setRoles(['ROLE_USER']);



                    foreach($category as $cat){
                        if ($cat->getName() === "Cuisine" ){
                      $newUser->addCategoryAffinity($cat);
                        }
                    

                   //git $newUser->addCategoryAffinity($category);


                    $newUser->addSubCatAffinity($subCategory);

                    $file = $form->get('image')->getData();
                    $newUser = $form->getData();
                        if ($file) {
                            $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                            $newUser->setImage($newFilename);
                        } else {
                            $newUser->setImage('https://cdn.pixabay.com/photo/2020/05/03/13/09/puppy-5124947_960_720.jpg');
                        }
            // 3) Encode the password (you could also do this via Doctrine listener)
                    $password = $passwordEncoder->encodePassword($newUser, $newUser->getPlainPassword());
                    $newUser->setPassword($password);

           
            // 4) save the User!
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($newUser);
                    $entityManager->flush();


                    $token = new UsernamePasswordToken(
                    $newUser,
                    $password,
                    'main',
                    $newUser->getRoles()
                    );

                    $this->get('security.token_storage')->setToken($token);
                    $this->get('session')->set('_security_main', serialize($token));

                    return $this->redirectToRoute('chooseTypeServices', ['id'=> $newUser->getId()]);
                
                }}}
            }
        }


        foreach($users as $user){
            return $this->render(
                'user/formInscription.html.twig',
                array('form' => $form->createView(),'user' => $user, 'content' => $ranking)
            );
        }

     
    }

    public function getUserAction(Request $request, UserRepository $userRepository, $id, CategoryRepository $categoryRepository, SubCategoryRepository $subCategoryRepository)
    {
        $user = $userRepository->find($id);
        $categories = $categoryRepository->findAll();
        $subCategories = $subCategoryRepository->findAll();

        $formUser = $this->createForm('App\Form\UserType', $user);
        $formUser->handleRequest($request);
       
        if ($formUser->isSubmitted() ) {
            $user = $formUser->getData();
            $file = $formUser->get('image')->getData();
            if ($file) {
                $newFileName = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                $user->setImage($newFileName);
            }

            $manager = $this->getDoctrine()->getManager();


            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('userProfile', ['id' => $id]);
        }

        
        return $this->render('user/profileUser.html.twig', ["user" => $user, "categories" => $categories, "subCategories" => $subCategories, "formUser" => $formUser->createView()]);
    }

    public function updateUserAction(UserRepository $userRepository, $id, Request $request)
    {
    }


    public function deleteUserAction()
    {
        /* Si user veut delete son profil */
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
