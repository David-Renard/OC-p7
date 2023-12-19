<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $customersAsArray =
            [
                ["firstname"=>"Jake","lastname"=>"Moulin","email"=>"jakem@yahoo.com",],
                ["firstname"=>"Jaxon","lastname"=>"Antoine","email"=>"jaxonantoin@hotmail.fr",],
                ["firstname"=>"Samuel","lastname"=>"Dumont","email"=>"samud@hotmail.com",],
                ["firstname"=>"Julian","lastname"=>"Dumas","email"=>"juliandu@hotmail.fr",],
                ["firstname"=>"Zoé","lastname"=>"Rolland","email"=>"zoérol@hotmail.fr",],
                ["firstname"=>"Sarah","lastname"=>"Gilbert","email"=>"sarahg@yahoo.com",],
                ["firstname"=>"Loic","lastname"=>"Denis","email"=>"lodeni@yahoo.fr",],
                ["firstname"=>"Maéva","lastname"=>"Herve","email"=>"maévah@hotmail.fr",],
                ["firstname"=>"Élodie","lastname"=>"Dumas","email"=>"élodieduma@gmail.com",],
                ["firstname"=>"Éléonore","lastname"=>"Leger","email"=>"éll@hotmail.com",],
                ["firstname"=>"Julian","lastname"=>"Jean","email"=>"julianjean@hotmail.com",],
                ["firstname"=>"William","lastname"=>"Gaillard","email"=>"williaga@yahoo.com",],
                ["firstname"=>"Thomas","lastname"=>"Leclercq","email"=>"thomale@gmail.com",],
                ["firstname"=>"Olivia","lastname"=>"Roussel","email"=>"olirou@hotmail.com",],
                ["firstname"=>"Adam","lastname"=>"Renault","email"=>"arenau@hotmail.com",],
                ["firstname"=>"Hannah","lastname"=>"Guichard","email"=>"hannahgu@yahoo.fr",],
                ["firstname"=>"Félix","lastname"=>"Leclerc","email"=>"félile@hotmail.fr",],
                ["firstname"=>"Charlie","lastname"=>"Dupuis","email"=>"chdupui@hotmail.fr",],
                ["firstname"=>"Antoine","lastname"=>"Richard","email"=>"ar@hotmail.fr",],
                ["firstname"=>"Caroline","lastname"=>"Louis","email"=>"clouis@hotmail.fr",],
                ["firstname"=>"Romy","lastname"=>"Roussel","email"=>"rrous@hotmail.fr",],
                ["firstname"=>"Loic","lastname"=>"Olivier","email"=>"loicolivi@gmail.com",],
                ["firstname"=>"Léonie","lastname"=>"Lacroix","email"=>"léolacr@yahoo.fr",],
                ["firstname"=>"Noah","lastname"=>"Vidal","email"=>"noahv@yahoo.fr",],
                ["firstname"=>"Félix","lastname"=>"Andre","email"=>"féandr@yahoo.fr",],
                ["firstname"=>"Audrey","lastname"=>"Antoine","email"=>"audreantoin@gmail.com",],
                ["firstname"=>"Jaxon","lastname"=>"Poirier","email"=>"jaxpoir@yahoo.com",],
                ["firstname"=>"Olivier","lastname"=>"Rey","email"=>"olivir@gmail.com",],
            ];

        for ($element = 0; $element < count($customersAsArray); $element++) {
            $customer = new Customer();
            $customer->setFirstname($customersAsArray[$element]['firstname']);
            $customer->setLastname($customersAsArray[$element]['lastname']);
            $customer->setEmail($customersAsArray[$element]['email']);

            $user = $this->getReference("user-".rand(0, 5));
            $customer->setClient($user);
            $manager->persist($customer);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }
}
