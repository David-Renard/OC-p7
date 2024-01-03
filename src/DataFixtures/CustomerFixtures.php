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
                ["firstname"=>"Jake","lastname"=>"Moulin","email"=>"jakem@yahoo.com","address"=>"11 rue de la Boétie, 01100 Aix-en-provence"],
                ["firstname"=>"Jaxon","lastname"=>"Antoine","email"=>"jaxonantoin@hotmail.fr","address"=>"16 rue Gontier-Patin, 13010 Aulnay-sous-bois",],
                ["firstname"=>"Samuel","lastname"=>"Dumont","email"=>"samud@hotmail.com","address"=>"18 rue Pierre De Coubertin, 13300 Coudekerque-branche",],
                ["firstname"=>"Julian","lastname"=>"Dumas","email"=>"juliandu@hotmail.fr","address"=>"17 rue Victor Hugo, 13090 CompiÈgne",],
                ["firstname"=>"Zoé","lastname"=>"Rolland","email"=>"zoérol@hotmail.fr","address"=>"23 cours Franklin Roosevelt, 14100 DÉcines-charpieu",],
                ["firstname"=>"Sarah","lastname"=>"Gilbert","email"=>"sarahg@yahoo.com","address"=>"26 boulevard Amiral Courbet, 31400 Dunkerque",],
                ["firstname"=>"Loic","lastname"=>"Denis","email"=>"lodeni@yahoo.fr","address"=>"27 boulevard d'Alsace, 33140 Eaubonne",],
                ["firstname"=>"Maéva","lastname"=>"Herve","email"=>"maévah@hotmail.fr","address"=>"3 Place Charles de Gaulle, 33600 Le Grand-quevilly",],
                ["firstname"=>"Élodie","lastname"=>"Dumas","email"=>"élodieduma@gmail.com","address"=>"37 boulevard Aristide Briand, 55100 Lisieux",],
                ["firstname"=>"Éléonore","lastname"=>"Leger","email"=>"éll@hotmail.com","address"=>"37 rue Léon Dierx, 59210 Marseille",],
                ["firstname"=>"Julian","lastname"=>"Jean","email"=>"julianjean@hotmail.com","address"=>"49 Cours Marechal-Joffre, 59640 Montreuil",],
                ["firstname"=>"William","lastname"=>"Gaillard","email"=>"williaga@yahoo.com","address"=>"5 Avenue Millies Lacroix, 60200 Oyonnax",],
                ["firstname"=>"Thomas","lastname"=>"Leclercq","email"=>"thomale@gmail.com","address"=>"5 Avenue Millies Lacroix, 67300 Pessac",],
                ["firstname"=>"Olivia","lastname"=>"Roussel","email"=>"olirou@hotmail.com","address"=>"51 rue des six frères Ruellan, 69150 Pontault-combault",],
                ["firstname"=>"Adam","lastname"=>"Renault","email"=>"arenau@hotmail.com","address"=>"58 rue du Président Roosevelt, 76120 Salon-de-provence",],
                ["firstname"=>"Hannah","lastname"=>"Guichard","email"=>"hannahgu@yahoo.fr","address"=>"7 rue Victor Hugo, 77340 Schiltigheim",],
                ["firstname"=>"Félix","lastname"=>"Leclerc","email"=>"félile@hotmail.fr","address"=>"70 Place du Jeu de Paume, 91270 Toulouse",],
                ["firstname"=>"Charlie","lastname"=>"Dupuis","email"=>"chdupui@hotmail.fr","address"=>"71 rue de la Mare aux Carats, 93100 Verdun",],
                ["firstname"=>"Antoine","lastname"=>"Richard","email"=>"ar@hotmail.fr","address"=>"90 rue Sadi Carnot, 93600 Vigneux-sur-seine",],
                ["firstname"=>"Caroline","lastname"=>"Louis","email"=>"clouis@hotmail.fr","address"=>"91 rue Clement Marot, 95600 Villenave-d'ornon",],
                ["firstname"=>"Romy","lastname"=>"Roussel","email"=>"rrous@hotmail.fr","address"=>"11 rue de la Boétie, 59640 Le Grand-quevilly",],
                ["firstname"=>"Loic","lastname"=>"Olivier","email"=>"loicolivi@gmail.com","address"=>"16 rue Gontier-Patin, 60200 Lisieux",],
                ["firstname"=>"Léonie","lastname"=>"Lacroix","email"=>"léolacr@yahoo.fr","address"=>"18 rue Pierre De Coubertin, 77340 Montreuil",],
                ["firstname"=>"Noah","lastname"=>"Vidal","email"=>"noahv@yahoo.fr","address"=>"17 rue Victor Hugo, 67300 Marseille",],
                ["firstname"=>"Félix","lastname"=>"Andre","email"=>"féandr@yahoo.fr","address"=>"27 boulevard d'Alsace, 33140 Salon-de-provence",],
                ["firstname"=>"Audrey","lastname"=>"Antoine","email"=>"audreantoin@gmail.com","address"=>"3 Place Charles de Gaulle, 33600 Schiltigheim",],
                ["firstname"=>"Jaxon","lastname"=>"Poirier","email"=>"jaxpoir@yahoo.com","address"=>"37 rue Léon Dierx, 31400 Verdun",],
                ["firstname"=>"Olivier","lastname"=>"Rey","email"=>"olivir@gmail.com","address"=>"26 boulevard Amiral Courbet, 93100 Pontault-combault",],
            ];

        for ($element = 0; $element < count($customersAsArray); $element++) {
            $customer = new Customer();
            $customer->setFirstname($customersAsArray[$element]['firstname']);
            $customer->setLastname($customersAsArray[$element]['lastname']);
            $customer->setEmail($customersAsArray[$element]['email']);
            $customer->setAddress($customersAsArray[$element]['address']);

//            for ($i = 0; $i < rand(0, 3); $i++) {
                $reseller = $this->getReference("reseller-".rand(0, 5));

//                $reseller->addCustomer($customer);
                $customer->setReseller($reseller);
                $manager->persist($customer);
//                $manager->persist($reseller);
//            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ResellerFixtures::class];
    }
}
