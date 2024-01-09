<?php

namespace App\Validator;

use App\Repository\CustomerRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsCustomersExistValidator extends ConstraintValidator
{
    public function __construct(private Security $security, private CustomerRepository $customerRepository) {}


    public function validate($value, Constraint $constraint)
    {
//        /* @var App\Validator\IsCustomersExist $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        $reseller = $this->security->getUser();
        if ($this->customerRepository->findBy(['reseller' => $reseller, 'email' => $value->getEmail()])) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
