<?php

namespace App\DataFixtures;

use App\Adapter\User\Users;
use App\Entity\ActorGrupe\ActorGrupe;
use App\Entity\Business\Business;
use App\Entity\CandidateProfil\CandidateProfil;
use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(\Doctrine\Persistence\ObjectManager $manager)
    {
        $data = array(
            array("name"=>"Cairo"),
            array("name"=>"Garrison"),
            array("name"=>"Armand"),
            array("name"=>"Myles"),
            array("name"=>"Richard"),
            array("name"=>"Robert"),
            array("name"=>"Garrison"),
            array("name"=>"Neil"),
            array("name"=>"Chaney"),
            array("name"=>"Herrod"),
            array("name"=>"Sylvester"),
            array("name"=>"Melvin"),
            array("name"=>"Nissim"),
            array("name"=>"Yuli"),
            array("name"=>"Hector"),
            array("name"=>"Dale"),
            array("name"=>"Kirk"),
            array("name"=>"Holmes"),
            array("name"=>"Hunter"),
            array("name"=>"Alvin"),
            array("name"=>"Fulton"),
            array("name"=>"Barclay"),
            array("name"=>"Judah"),
            array("name"=>"Upton"),
            array("name"=>"Vladimir"),
            array("name"=>"Honorato"),
            array("name"=>"Conan"),
            array("name"=>"Hakeem"),
            array("name"=>"Phillip"),
            array("name"=>"Hayden"),
            array("name"=>"Boris"),
            array("name"=>"Amos"),
            array("name"=>"Kenyon"),
            array("name"=>"Owen"),
            array("name"=>"Herman"),
            array("name"=>"Orlando"),
            array("name"=>"Stewart"),
            array("name"=>"Solomon"),
            array("name"=>"Giacomo"),
            array("name"=>"Keegan"),
            array("name"=>"Malik"),
            array("name"=>"Hilel"),
            array("name"=>"Vincent"),
            array("name"=>"Kareem"),
            array("name"=>"Craig"),
            array("name"=>"Marvin"),
            array("name"=>"Walter"),
            array("name"=>"Jonas"),
            array("name"=>"Andrew"),
            array("name"=>"Palmer"),
            array("name"=>"Bevis"),
            array("name"=>"Elijah"),
            array("name"=>"Burton"),
            array("name"=>"Rajah"),
            array("name"=>"Owen"),
            array("name"=>"Wing"),
            array("name"=>"Connor"),
            array("name"=>"Aaron"),
            array("name"=>"Boris"),
            array("name"=>"Tucker"),
            array("name"=>"Deacon"),
            array("name"=>"Travis"),
            array("name"=>"Vaughan"),
            array("name"=>"Oscar"),
            array("name"=>"Lars"),
            array("name"=>"Ignatius"),
            array("name"=>"Cairo"),
            array("name"=>"Gary"),
            array("name"=>"Gary"),
            array("name"=>"Griffin"),
            array("name"=>"Hilel"),
            array("name"=>"Brendan"),
            array("name"=>"Ulric"),
            array("name"=>"Kareem"),
            array("name"=>"Cooper"),
            array("name"=>"Aaron"),
            array("name"=>"Palmer"),
            array("name"=>"Magee"),
            array("name"=>"Aristotle"),
            array("name"=>"Malcolm"),
            array("name"=>"Brock"),
            array("name"=>"Troy"),
            array("name"=>"Knox"),
            array("name"=>"Giacomo"),
            array("name"=>"Andrew"),
            array("name"=>"Dillon"),
            array("name"=>"David"),
            array("name"=>"Tiger"),
            array("name"=>"Kuame"),
            array("name"=>"Castor"),
            array("name"=>"Hu"),
            array("name"=>"Elvis"),
            array("name"=>"Jacob"),
            array("name"=>"Buckminster"),
            array("name"=>"Malcolm"),
            array("name"=>"Channing"),
            array("name"=>"Lewis"),
            array("name"=>"Asher"),
            array("name"=>"Zeph"),
            array("name"=>"Nasim")
        );

        $usergroup = new User('Group',
            'Group@o2.pl',
            "123456",
            ["ROLE_GROUP"]);
        $usergroup->setIsActive(true);
        $manager->persist($usergroup);

        $group = new ActorGrupe($usergroup, 'Group', 'adres', '11111111', 'asdasdassd');
        $manager->persist($group);
        $usergroup->setActorGrupe($group);
        $manager->persist($usergroup);

        $userbusiness = new User('business',
            'business@o2.pl',
            "123456",
            ["ROLE_BUSINESS"]);
        $userbusiness->setIsActive(true);
        $manager->persist($userbusiness);

        $group = new Business($userbusiness,"business",'000000000','adrs','000000000','doscription');
        $manager->persist($group);
        $userbusiness->setBusiness($group);
        $manager->persist($userbusiness);


        $name= $data[rand(0,100)]["name"];
        $user=new User(
            'candidate',
            'candidate@o2.pl',
            '123456',
            ["ROLE_CANDIDATE"]
        );
        $user->setToken(null)
            ->setIsActive(true)
            ->setTokenExpire(null);
        $manager->persist($user);

        $profil=new CandidateProfil($user,
            rand(1,250),
            array_rand(CandidateProfil::PHYSIQUES, 1),
            array_rand(CandidateProfil::HAIRLENGTHS,1),
            array_rand(CandidateProfil::HAIRCOLORS,1),
            array_rand(CandidateProfil::EYRCOLORS,1),
            rand(1,100)
        );
        $manager->persist($profil);
        $user->setCandidateProfil($profil);
        $manager->persist($user);



        for ($i=0;$i<200;$i++){
            $name=$data[rand(0,99)]["name"].rand(1,1000);
            $user=new User(
                $name,
                $name.'@o2.pl',
                $name,
                ["ROLE_CANDIDATE"]
            );
            $user->setToken(null)
                ->setIsActive(true)
                ->setTokenExpire(null);
            $manager->persist($user);

            $profil=new CandidateProfil($user,
            rand(1,250),
                array_rand(CandidateProfil::PHYSIQUES, 1),
            array_rand(CandidateProfil::HAIRLENGTHS,1),
            array_rand(CandidateProfil::HAIRCOLORS,1),
            array_rand(CandidateProfil::EYRCOLORS,1),
            rand(1,100)
            );
            $manager->persist($profil);
            $user->setCandidateProfil($profil);
            $manager->persist($user);
        }
        $manager->flush();


    }
}
