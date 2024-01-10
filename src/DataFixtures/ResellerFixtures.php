<?php

namespace App\DataFixtures;

use App\Entity\Reseller;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResellerFixtures extends Fixture
{


    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $usersAsArray = [
                         [
                             'email'    => "dev@fnac.com",
                             'company'  => "FNAC",
                             'password' => "FnEAla!eaM54",
                         ],
                         [
                             'email'    => "dev@orange.fr",
                             'company'  => "ORANGE",
                             'password' => "QnwXBoHu!q4qGe5",
                         ],
                         [
                             'email'    => "dev@sfr.fr",
                             'company'  => "SFR",
                             'password' => "nBHqwS!qDYHg4Ml",
                         ],
                         [
                             'email'    => "dev@boulanger.com",
                             'company'  => "BOULANGER",
                             'password' => "451MlqFhgi!d4FfC",
                         ],
                         [
                             'email'    => "dev@bouygues.fr",
                             'company'  => "BOUYGUES",
                             'password' => "nBd419!S25!qqQcv",
                         ],
                         [
                             'email'    => "dev@free.fr",
                             'company'  => "FREE",
                             'password' => "NbnhG4965Fu10I!",
                         ],
                        ];

        for ($i = 0 ; $i < 6; $i++) {
            $reseller = new Reseller();
            $reseller->setCompanyName($usersAsArray[$i]['company']);
            $reseller->setName("Service informatique ".$reseller->getCompanyName());
            $reseller->setEmail($usersAsArray[$i]['email']);
            $reseller->setPassword($this->passwordHasher->hashPassword($reseller, $usersAsArray[$i]['password']));

            $this->addReference("reseller-".$i, $reseller);
            $manager->persist($reseller);
        }

        $manager->flush();
    }

}
