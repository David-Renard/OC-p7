<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;


#[\Attribute]
class IsCustomersExist extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = '!!! Il existe déjà.';

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}
