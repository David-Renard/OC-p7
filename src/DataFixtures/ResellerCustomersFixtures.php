<?php

namespace App\DataFixtures;

use App\Entity\Reseller;
use App\Repository\ResellerRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ResellerCustomersFixtures extends Fixture implements DependentFixtureInterface
{

    public function __construct(private readonly ResellerRepository $resellerRepository) {}

    public function load(ObjectManager $manager): void
    {
        $randNbCustomer = rand(0, 5);
        for ($j=0; $j < $randNbCustomer; $j++) {
            $customer = $this->getReference("customer-".rand(0, 26));
            $reseller = $this->resellerRepository->find(rand(1,6));
            $reseller->addCustomer($customer);

            $manager->persist($reseller);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CustomerFixtures::class];
    }
}