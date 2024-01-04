<?php

namespace App\State;

use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;


readonly class CustomerProcessor implements ProcessorInterface
{
    public function __construct(private Security $security, private ProcessorInterface $persistProcessor, private ProcessorInterface $removeProcessor)
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($operation instanceof DeleteOperationInterface) {
            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }

        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function (object $object, string $format, array $context): string {
                return $object->getName();
            },
        ];

        $reseller = $this->security->getUser();
        $data->setReseller($reseller);

        return $this->persistProcessor->process($data, $operation, $uriVariables, $defaultContext);
    }
}
