<?php

namespace App\DataFixtures;

use App\Entity\SubCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SubCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $subCatPlomberie = new SubCategory();
        $subCatPlomberie->setName("Toilettes bouchées")
                        ->setImage("https://www.debouchage-general.be/wp-content/uploads/2016/11/wc-bouch%C3%A9.png")
        ;
        $manager->persist($subCatPlomberie);

        $subCatDemenagements = new SubCategory();
        $subCatDemenagements->setName("Aide aux déménagements")
                        ->setImage("https://img2.freepng.fr/20180418/utq/kisspng-mover-self-storage-relocation-parcel-transport-parcel-5ad7d8f093dcb5.5294455015240952166057.jpg")
        ;
        $manager->persist($subCatDemenagements);

        $subCatCuisine = new SubCategory();
        $subCatCuisine->setName("Péparer un gâteau")
                        ->setImage("https://i.pinimg.com/originals/08/08/71/080871450381cccdcd41ad770889a8ec.png")
        ;
        $manager->persist($subCatCuisine);

        $subCatJardinage = new SubCategory();
        $subCatJardinage->setName("Tonte de pelouse")
                        ->setImage("https://static.cms.yp.ca/ecms/media/2/3056012_xl-1442438524-600x360.jpg")
        ;
        $manager->persist($subCatJardinage);

        $subCatMecanique = new SubCategory();
        $subCatMecanique->setName("Changer pneu")
                        ->setImage("https://www.go-pneus-occasion.fr/userfiles/10186/pneus-occasions-le-muy-01-reparation.png")
        ;
        $manager->persist($subCatMecanique);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
