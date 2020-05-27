<?php

namespace App\DataFixtures;

use App\Entity\Faq;
use App\Entity\User;
use App\Entity\MailBox;
use App\Entity\Ranking;
use App\Entity\Service;
use App\Entity\Category;
use App\Entity\Duration;
use App\Entity\SubCategory;
use App\Entity\TypeService;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
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

        $catAmmeublement = new Category();
        $catAmmeublement->setName("Ammeublement")
            ->setImage("https://www.interdemenagement.com/wp-content/uploads/sites/5095/2017/11/carton.png");
        $manager->persist($catAmmeublement);

        $catAide = new Category();
        $catAide->setName("Aides")
            ->setImage("https://www.interdemenagement.com/wp-content/uploads/sites/5095/2017/11/carton.png");
        $manager->persist($catAide);

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

        $catAnimaux = new Category();
        $catAnimaux->setName("Animaux")
            ->setImage("https://img2.freepng.fr/20180516/xkw/kisspng-mechanical-engineering-car-mechanics-design-engine-5afc650f09ae93.9112691115264903830397.jpg");
        $manager->persist($catAnimaux);


        // séparation entre category et subcategory

        $subCatPlomberie = new SubCategory();
        $subCatPlomberie->setName("Toilettes bouchées")
            ->setImage("https://www.debouchage-general.be/wp-content/uploads/2016/11/wc-bouch%C3%A9.png")
            ->setCategory($catPlomberie);
        $manager->persist($subCatPlomberie);

        $subCatAide = new SubCategory();
        $subCatAide->setName("Aides diverses")
            ->setImage("https://www.debouchage-general.be/wp-content/uploads/2016/11/wc-bouch%C3%A9.png")
            ->setCategory($catAide);
        $manager->persist($subCatAide);

        $subCatPetSitter = new SubCategory();
        $subCatPetSitter->setName("PetSitter")
            ->setImage("https://www.debouchage-general.be/wp-content/uploads/2016/11/wc-bouch%C3%A9.png")
            ->setCategory($catAnimaux);
        $manager->persist($subCatPetSitter);

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
        $subCatMecanique->setName("Changer des pneus")
            ->setImage("https://www.go-pneus-occasion.fr/userfiles/10186/pneus-occasions-le-muy-01-reparation.png")
            ->setCategory($catMecanique);
        $manager->persist($subCatMecanique);

        $subcatMontageMeuble = new SubCategory();
        $subcatMontageMeuble->setName("Aide au montage de meuble")
            ->setImage("https://www.go-pneus-occasion.fr/userfiles/10186/pneus-occasions-le-muy-01-reparation.png")
            ->setCategory($catAmmeublement);
        $manager->persist($subcatMontageMeuble);
        

        // séparation entre subcategory et Ranking
        $rankNewbie = new Ranking();
        $rankNewbie->setName('Newbie')
        ->setCount('0')
        ->setLogo("https://toppng.com/uploads/preview/babys-room-icon-baby-icon-11553449311dwd4ky7lpi.png");
        $manager->persist($rankNewbie);


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

                    $user1 = new User();
                    $user1->setEmail('philippe.sanogo@gmail.com')
                           ->setRoles(['ROLE_USER'])
                           ->setPassword($this->passwordEncoder->encodePassword($user1, 'root'))
                           ->setLastname('SANOGO')
                           ->setFirstname('Phillipe')
                           ->setCity('Strasbourg')
                           ->setPostalCode('67000')
                           ->setImage('https://cours.wf3.fr/app/avatars/users/2806/2806-sanogo-phillipe.jpeg')
                           ->setTimeGauge('0')
                           ->setTotalTimeServiceGiven('0')
                            ->setRanking($rankNewbie);
                    
                           
                    $manager->persist($user1);
            
                    $user2 = new User();
                    $user2->setEmail('Vladimir.Popo@gmail.com')
                           ->setRoles(['ROLE_USER'])
                           ->setPassword($this->passwordEncoder->encodePassword($user2, 'root'))
                           ->setLastname('Popovic')
                           ->setFirstname('Vladimir')
                           ->setCity('Strasbourg')
                           ->setPostalCode('67000')
                           ->setImage('https://cours.wf3.fr/app/avatars/users/2796/2796-scheffer-eric.jpeg')
                           ->setTimeGauge('0')
                           ->setTotalTimeServiceGiven('0')
                            ->setRanking($rankNewbie);
                    
                           
                    $manager->persist($user2);
            
                    $user3 = new User();
                    $user3->setEmail('vazvieirafrederic@outlook.fr')
                           ->setRoles(['ROLE_USER'])
                           ->setPassword($this->passwordEncoder->encodePassword($user3, 'root'))
                           ->setLastname('VAZ VIEIRA')
                           ->setFirstname('Frédéric')
                           ->setCity('Molsheim')
                           ->setPostalCode('67000')
                           ->setImage('https://cours.wf3.fr/img/profil-male.png')
                           ->setTimeGauge('0')
                           ->setTotalTimeServiceGiven('0')
                            ->setRanking($rankNewbie);
                        
                           
                    $manager->persist($user3);
            
                    $user4 = new User();
                    $user4->setEmail('sam@outlook.fr')
                           ->setRoles(['ROLE_USER'])
                           ->setPassword($this->passwordEncoder->encodePassword($user4, 'root'))
                           ->setLastname('DUBOIS')
                           ->setFirstname('Samantha')
                           ->setCity('Schiltigheim')
                           ->setPostalCode('67000')
                           ->setImage('https://cours.wf3.fr/img/profil-female.png')
                           ->setTimeGauge('0')
                           ->setTotalTimeServiceGiven('0')
                            ->setRanking($rankNewbie);

                           
                    $manager->persist($user4);
        
            // séparation entre Duration et Typeservices

                $typeServiceBesoin = new TypeService();
                $typeServiceBesoin->setName('Besoin d\'un service');
                $manager->persist($typeServiceBesoin);

                $typeServiceRendre = new TypeService();
                $typeServiceRendre->setName('Rendre service');
                $manager->persist($typeServiceRendre);
            

                // séparation entre Typeservices et services

            
                $service = new Service();
                $service->setName('Changer les pneus de ma voiture')
               ->setDescription('Bonjour, j\'aurai besoin d\'aide afin de changer les roues de ma voiture. Je suis très bon en cuisine, je peux vous préparer le plat que vous souhaitez.')
               ->setCreatedAt(new \DateTime())
               ->setStatus('En cours')
               ->setImage('https://cdn.pixabay.com/photo/2017/06/07/10/47/elephant-2380009_960_720.jpg')
                ->setDuration($duration_60)
                ->setUser($user4)
                ->setTypeService($typeServiceBesoin)
                ->setSubCategory($subCatMecanique);        
                $manager->persist($service);

                $service = new Service();
                $service->setName('Montage d\'un meuble')
               ->setDescription('Bonjour, je viens de recevoir un vaisselier. Vivant seul et sans outillage, y aurait-il une âme charitable pour m\'aider? Etant étudiant en droit, je peux apporter du soutien scolaire ou vous apporter de l\'aide si vous avez la moindre question ')
               ->setCreatedAt(new \DateTime())
               ->setStatus('En cours')
               ->setImage('https://cdn.pixabay.com/photo/2017/06/07/10/47/elephant-2380009_960_720.jpg')
                ->setDuration($duration_90)
                ->setUser($user)
                ->setTypeService($typeServiceBesoin)
                ->setSubCategory($subcatMontageMeuble);          
                $manager->persist($service);

                $service = new Service();
                $service->setName('Garder vos animaux')
               ->setDescription("Bonjour, je viens d'arriver dans la région et je ne connais pas grand monde. J'adore les animaux et vivant en appartement, je ne peux pas en avoir. Je suis donc disponible pour garder vos adorables petites bêtes et pouvoir rencontrer de nouvelles personnes")
               ->setCreatedAt(new \DateTime())
               ->setStatus('En cours')
               ->setImage('https://cdn.pixabay.com/photo/2017/06/07/10/47/elephant-2380009_960_720.jpg')
                ->setDuration($duration_60)
                ->setUser($user3)
                ->setTypeService($typeServiceRendre)
                ->setSubCategory($subCatPetSitter);          
                $manager->persist($service);


                
                
                //  le premier enregistrement de la table de base de données
                $message = new Mailbox();        
                $message->setUserFrom($user1)
                        ->setUserFor($user2)
                        ->setMessageTitle('Hello')
                        ->setMessageBody('Bonjour Vladimir ! Comment vas tu ? ')
                        ->setCreatedAt(new \DateTime());
                $manager->persist($message);
        
                $message = new Mailbox();        
                $message->setUserFrom($user2)
                        ->setUserFor($user1)
                        ->setMessageTitle('Alo')
                        ->setMessageBody('Bonjour Monsieur SanLogo ! Attendez attendez ! Je ne parle pas bien français')
                        ->setCreatedAt(new \DateTime());
                $manager->persist($message);
        
                $message = new Mailbox();        
                $message->setUserFrom($user1)
                        ->setUserFor($user2)
                        ->setMessageTitle('Hello')
                        ->setMessageBody('Ahahah Sacré Vladimir !')
                        ->setCreatedAt(new \DateTime());
                $manager->persist($message);

                $faq1 = new Faq();        
                $faq1->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq1);

                $faq2 = new Faq();        
                $faq2->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq2);

                $faq3 = new Faq();        
                $faq3->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq3);

                $faq4 = new Faq();        
                $faq4->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq4);

                $faq5 = new Faq();        
                $faq5->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq5);

                $faq6 = new Faq();        
                $faq6->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq6);

                $faq7 = new Faq();        
                $faq7->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq7);

                $faq8 = new Faq();        
                $faq8->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq8);

                $faq9 = new Faq();        
                $faq9->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq9);
                
                $faq10 = new Faq();        
                $faq10->setQuestion(" Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, officia ? ")
                        ->setAnswer(" Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste debitis perspiciatis animi harum totam ex ullam molestias porro ea libero! ");                        
                $manager->persist($faq10);

        $manager->flush();
    }
}
