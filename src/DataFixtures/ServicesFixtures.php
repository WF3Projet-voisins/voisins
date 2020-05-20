<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Service;

class ServicesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);



        $service = new Service();
         $service->setName('Maçon')
               ->setDescription('Construit tout ce que vous voulez')
               ->setCreatedAt(new \DateTime())
               ->setStatus('Ouvrier')
               ->setImage('https://cdn.pixabay.com/photo/2017/06/07/10/47/elephant-2380009_960_720.jpg');
             
               
        $manager->persist($service);
        $manager->flush();

    }
}
