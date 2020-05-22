<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Mailbox;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class MailboxFixtures extends Fixture
{

        private $passwordEncoder;

        public function __construct(UserPasswordEncoderInterface $passwordEncoder)
        {
                $this->passwordEncoder = $passwordEncoder;
        }
    
    public function load(ObjectManager $manager)
    {

        $user1 = new User();
        $user1->setEmail('philippe.sanogo@gmail.com')
               ->setRoles(['ROLE_USER'])
               ->setPassword($this->passwordEncoder->encodePassword($user1, 'user1'))
               ->setLastname('SANOGO')
               ->setFirstname('Phillipe')
               ->setCity('Strasbourg')
               ->setPostalCode('67000')
               ->setImage('https://cours.wf3.fr/app/avatars/users/2806/2806-sanogo-phillipe.jpeg')
               ->setTimeGauge('0')
               ->setTotalTimeServiceGiven('0');
               
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('eric.scheffer.pro@gmail.com')
               ->setRoles(['ROLE_USER'])
               ->setPassword($this->passwordEncoder->encodePassword($user2, 'user2'))
               ->setLastname('SCHEFFER')
               ->setFirstname('Eric')
               ->setCity('Strasbourg')
               ->setPostalCode('67000')
               ->setImage('https://cours.wf3.fr/app/avatars/users/2796/2796-scheffer-eric.jpeg')
               ->setTimeGauge('0')
               ->setTotalTimeServiceGiven('0');
               
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('vazvieirafrederic@outlook.fr')
               ->setRoles(['ROLE_USER'])
               ->setPassword($this->passwordEncoder->encodePassword($user3, 'user3'))
               ->setLastname('VAZ VIEIRA')
               ->setFirstname('Frédéric')
               ->setCity('Strasbourg')
               ->setPostalCode('67000')
               ->setImage('https://cours.wf3.fr/img/profil-male.png')
               ->setTimeGauge('0')
               ->setTotalTimeServiceGiven('0');
               
        $manager->persist($user3);

        $user4 = new User();
        $user4->setEmail('sam@outlook.fr')
               ->setRoles(['ROLE_USER'])
               ->setPassword($this->passwordEncoder->encodePassword($user4, 'user4'))
               ->setLastname('DUBOIS')
               ->setFirstname('Samantha')
               ->setCity('Strasbourg')
               ->setPostalCode('67000')
               ->setImage('https://cours.wf3.fr/img/profil-female.png')
               ->setTimeGauge('0')
               ->setTotalTimeServiceGiven('0');
               
        $manager->persist($user4);

       $manager->flush();
        
        //  le premier enregistrement de la table de base de données
        $message = new Mailbox();        
        $message->setUserFrom($user1)
                ->setUserFor($user2)
                ->setMessageTitle('Title 1')
                ->setMessageBody('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s')
                ->setCreatedAt(new \DateTime());
        $manager->persist($message);

        $message = new Mailbox();        
        $message->setUserFrom($user2)
                ->setUserFor($user1)
                ->setMessageTitle('Title 2')
                ->setMessageBody('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s')
                ->setCreatedAt(new \DateTime());
        $manager->persist($message);

        $message = new Mailbox();        
        $message->setUserFrom($user1)
                ->setUserFor($user2)
                ->setMessageTitle('Title 3')
                ->setMessageBody('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s')
                ->setCreatedAt(new \DateTime());
        $manager->persist($message);
        
        $manager->flush();

    }
}