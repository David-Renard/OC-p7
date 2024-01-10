<?php

namespace App\State;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Customer;
use App\Exception\UniqueConstraintsViolationException;
use App\Repository\CustomerRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;


#[AsDecorator('api_platform.doctrine.orm.state.persist_processor')]
readonly class CustomerProcessor implements ProcessorInterface
{
    public function __construct(private Security $security, private ProcessorInterface $persistProcessor)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($data instanceof Customer && $this->security->getUser()) {
            $reseller = $this->security->getUser();
            $data->setReseller($reseller);
        }

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
