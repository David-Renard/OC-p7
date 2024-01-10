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
    public $message = 'Un client avec cette adresse mail existe déjà dans votre portefeuille!';

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }
}
