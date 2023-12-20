<?php

namespace App\DataFixtures;

use App\Entity\Reseller;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResellerFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        $usersAsArray = [
            [
                'company'  => "FNAC",
                'email'    => "dev@fnac.com",
                'password' => "FnEAla!eaM54",
            ],
            [
                'company'  => "ORANGE",
                'email'    => "dev@orange.fr",
                'password' => "QnwXBoHu!q4qGe5",
            ],
            [
                'company'  => "SFR",
                'email'    => "dev@sfr.fr",
                'password' => "nBHqwS!qDYHg4Ml",
            ],
            [
                'company'  => "BOULANGER",
                'email'    => "dev@boulanger.com",
                'password' => "451MlqFhgi!d4FfC",
            ],
            [
                'company'  => "BOUYGUES",
                'email'    => "dev@bouygues.fr",
                'password' => "nBd419!S25!qqQcv",
            ],
            [
                'company'  => "FREE",
                'email'    => "dev@free.fr",
                'password' => "NbnhG4965Fu10I!",
            ],
        ];

        for ($i = 0 ; $i < count($usersAsArray); $i++) {
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
