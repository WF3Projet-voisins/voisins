<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
         $user = new User();
         $user->setEmail('root@root.fr')
               ->setRoles(['ROLE_USER'])
               ->setPassword($this->passwordEncoder->encodePassword($user, 'root'))
               ->setLastname('Dupont')
               ->setFirstname('Root')
               ->setCity('Strasbourg')
               ->setPostalCode('67000')
               ->setImage('https://cdn.pixabay.com/photo/2017/06/07/10/47/elephant-2380009_960_720.jpg')
               ->setTimeGauge('0')
               ->setTotalTimeServiceGiven('0');
               
        $manager->persist($user);
        $manager->flush();
    }
}
