<?php

namespace App\ApiPlatform;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Customer;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;

readonly class CustomersByResellerExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{

    public function __construct(private Security $security){}

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void
    {
        $this->customersByReseller($resourceClass, $queryBuilder);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, Operation $operation = null, array $context = []): void
    {
        $this->customersByReseller($resourceClass, $queryBuilder);
    }

    private function customersByReseller(string $resourceClass, QueryBuilder $queryBuilder): void
    {
        if (Customer::class !== $resourceClass) { return;}

        $rootAlias = $queryBuilder->getRootAliases()[0];
        $user = $this->security->getUser();
        if ($user) {
            $query = $queryBuilder->andWhere($rootAlias.'.reseller = :reseller')
                ->setParameter('reseller', $user);

//            $queryBuilder->andWhere(sprintf('%s.firstname = :firstname', $rootAlias))
//                ->setParameter('firstname', 'Loic');
        }
    }
}