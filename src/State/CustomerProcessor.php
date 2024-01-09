<?php

namespace App\State;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Exception\UniqueConstraintsViolationException;
use App\Repository\CustomerRepository;
use Symfony\Bundle\SecurityBundle\Security;


readonly class CustomerProcessor implements ProcessorInterface
{
    public function __construct(private CustomerRepository $customerRepository, private Security $security, private ProcessorInterface $persistProcessor, private ProcessorInterface $removeProcessor)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($operation instanceof DeleteOperationInterface) {
            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }

        $reseller = $this->security->getUser();
        if ($this->customerRepository->findBy(['reseller' => $reseller, 'email' => $data->getEmail()])) {
            throw new UniqueConstraintsViolationException(400, "Un client avec cette adresse mail existe déjà dans votre portefeuille.");
        }

        $data->setReseller($reseller);

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
