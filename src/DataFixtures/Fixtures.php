<?php

namespace App\DataFixtures;

use App\Entity\Service;
use App\Entity\Duration;
use App\Entity\User;
use App\Entity\Ranking;
use App\Entity\Category;
use App\Entity\SubCategory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class SubCategoryFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $catPlomberie = new Category();
        $catPlomberie->setName("Plomberie")
            ->setImage("https://www.plombier-vilet-thionville.fr/img/logo-icon.png");
        $manager->persist($catPlomberie);

        $catDemenagements = new Category();
        $catDemenagements->setName("Déménagements")
            ->setImage("https://www.interdemenagement.com/wp-content/uploads/sites/5095/2017/11/carton.png");
        $manager->persist($catDemenagements);

        $catCuisine = new Category();
        $catCuisine->setName("Cuisine")
            ->setImage("https://i.pinimg.com/originals/fb/71/b9/fb71b9d42001665a1f1b8df900a32b81.jpg");
        $manager->persist($catCuisine);

        $catJardinage = new Category();
        $catJardinage->setName("Jardinage")
            ->setImage("https://www.mpa-pro.fr/resize/360x360/zc/3/f/0/src/sites/mpapro/files/products/d11395.png");
        $manager->persist($catJardinage);

        $catMecanique = new Category();
        $catMecanique->setName("Mécanique")
            ->setImage("https://img2.freepng.fr/20180516/xkw/kisspng-mechanical-engineering-car-mechanics-design-engine-5afc650f09ae93.9112691115264903830397.jpg");
        $manager->persist($catMecanique);



        // séparation entre category et subcategory

        $subCatPlomberie = new SubCategory();
        $subCatPlomberie->setName("Toilettes bouchées")
            ->setImage("https://www.debouchage-general.be/wp-content/uploads/2016/11/wc-bouch%C3%A9.png")
            ->setCategory($catPlomberie);
        $manager->persist($subCatPlomberie);

        $subCatDemenagements = new SubCategory();
        $subCatDemenagements->setName("Aide aux déménagements")
            ->setImage("https://img2.freepng.fr/20180418/utq/kisspng-mover-self-storage-relocation-parcel-transport-parcel-5ad7d8f093dcb5.5294455015240952166057.jpg")
            ->setCategory($catDemenagements);
        $manager->persist($subCatDemenagements);

        $subCatCuisine = new SubCategory();
        $subCatCuisine->setName("Péparer un gâteau")
            ->setImage("https://i.pinimg.com/originals/08/08/71/080871450381cccdcd41ad770889a8ec.png")
            ->setCategory($catCuisine);
        $manager->persist($subCatCuisine);

        $subCatJardinage = new SubCategory();
        $subCatJardinage->setName("Tonte de pelouse")
            ->setImage("https://static.cms.yp.ca/ecms/media/2/3056012_xl-1442438524-600x360.jpg")
            ->setCategory($catJardinage);
        $manager->persist($subCatJardinage);

        $subCatMecanique = new SubCategory();
        $subCatMecanique->setName("Changer pneu")
            ->setImage("https://www.go-pneus-occasion.fr/userfiles/10186/pneus-occasions-le-muy-01-reparation.png")
            ->setCategory($catMecanique);
        $manager->persist($subCatMecanique);
        // $product = new Product();
        // $manager->persist($product);

        // séparation entre subcategory et Ranking
        $rankNewbie = new Ranking();
        $rankNewbie->setName('Newbie')
        ->setCount('0')
        ->setLogo("https://toppng.com/uploads/preview/babys-room-icon-baby-icon-11553449311dwd4ky7lpi.png");
        $manager->persist($rankNewbie);



        // séparation entre Ranking et User
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
            ->setTotalTimeServiceGiven('0')
            ->addCategoryAffinity($catJardinage)
            ->addSubCatAffinity($subCatJardinage)
            ->setRanking($rankNewbie);

        
            

        $manager->persist($user);

        // séparation entre User et duration


        $duration_30 = new Duration();
         $duration_30->setDuration('30');
        $manager->persist($duration_30);

        $duration_60 = new Duration();
        $duration_60->setDuration('60');
       $manager->persist($duration_60);

       $duration_90 = new Duration();
       $duration_90->setDuration('90');
      $manager->persist($duration_90);

      $manager->persist($duration_30);
      $manager->persist($duration_60);
      $manager->persist($duration_90);





        // séparation entre Duration et services


                $service = new Service();
                $service->setName('Maçon')
               ->setDescription('Construit tout ce que vous voulez')
               ->setCreatedAt(new \DateTime())
               ->setStatus('Ouvrier')
               ->setImage('https://cdn.pixabay.com/photo/2017/06/07/10/47/elephant-2380009_960_720.jpg')
                ->setDuration($duration_60)
                ->setUser('8');
               
                $manager->persist($service);


        $manager->flush();
    }
}
