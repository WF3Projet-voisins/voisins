<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $catPlomberie = new Category();
        $catPlomberie->setName("Plomberie")
                        ->setImage("https://www.plombier-vilet-thionville.fr/img/logo-icon.png")
        ;
        $manager->persist($catPlomberie);

        $catDemenagements = new Category();
        $catDemenagements->setName("Déménagements")
                        ->setImage("https://www.interdemenagement.com/wp-content/uploads/sites/5095/2017/11/carton.png")
        ;
        $manager->persist($catDemenagements);

        $catCuisine = new Category();
        $catCuisine->setName("Cuisine")
                        ->setImage("https://i.pinimg.com/originals/fb/71/b9/fb71b9d42001665a1f1b8df900a32b81.jpg")
        ;
        $manager->persist($catCuisine);

        $catJardinage = new Category();
        $catJardinage->setName("Jardinage")
                        ->setImage("https://www.mpa-pro.fr/resize/360x360/zc/3/f/0/src/sites/mpapro/files/products/d11395.png")
        ;
        $manager->persist($catJardinage);

        $catMecanique = new Category();
        $catMecanique->setName("Mécanique")
                        ->setImage("https://img2.freepng.fr/20180516/xkw/kisspng-mechanical-engineering-car-mechanics-design-engine-5afc650f09ae93.9112691115264903830397.jpg")
        ;
        $manager->persist($catMecanique);
        $manager->flush();
    }
}
