<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Duration;

class DurationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);



        $duration = new Duration();
         $duration->setDuration('30');
        $manager->persist($duration);

        $duration = new Duration();
        $duration->setDuration('60');
       $manager->persist($duration);

       $duration = new Duration();
       $duration->setDuration('90');
      $manager->persist($duration);




        










        $manager->flush();
    }
}
