<?php

namespace App\State;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Exception\UniqueConstraintsViolationException;
use App\Repository\CustomerRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;


#[AsDecorator('api_platform.doctrine.orm.state.persist_processor')]
readonly class CustomerProcessor implements ProcessorInterface
{
    public function __construct(private CustomerRepository $customerRepository, private Security $security, private ProcessorInterface $persistProcessor)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $reseller = $this->security->getUser();
        if ($this->customerRepository->findBy(['reseller' => $reseller, 'email' => $data->getEmail()])) {
            throw new UniqueConstraintsViolationException(422, "Un client avec cette adresse mail existe déjà dans votre portefeuille.");
        }

        $data->setReseller($reseller);

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
