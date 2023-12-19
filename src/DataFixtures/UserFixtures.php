<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        $usersAsArray = [
            [
                'name'     => "FNAC",
                'email'    => "dev@fnac.com",
                'password' => "FnEAla!eaM54",
            ],
            [
                'name'     => "ORANGE",
                'email'    => "dev@orange.fr",
                'password' => "QnwXBoHu!q4qGe5",
            ],
            [
                'name'     => "SFR",
                'email'    => "dev@sfr.fr",
                'password' => "nBHqwS!qDYHg4Ml",
            ],
            [
                'name'     => "BOULANGER",
                'email'    => "dev@boulanger.com",
                'password' => "451MlqFhgi!d4FfC",
            ],
            [
                'name'     => "BOUYGUES",
                'email'    => "dev@bouygues.fr",
                'password' => "nBd419!S25!qqQcv",
            ],
            [
                'name'     => "FREE",
                'email'    => "dev@free.fr",
                'password' => "NbnhG4965Fu10I!",
            ],
        ];

        for ($i = 0 ; $i < count($usersAsArray); $i++) {
            $user = new User();
            $user->setName($usersAsArray[$i]['name']);
            $user->setEmail($usersAsArray[$i]['email']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $usersAsArray[$i]['password']));

            $this->addReference("user-".$i, $user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
