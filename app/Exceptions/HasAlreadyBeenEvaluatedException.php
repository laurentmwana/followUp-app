<?php

namespace App\Exceptions;

use Exception;

class HasAlreadyBeenEvaluatedException extends Exception
{
    public function _construct(bool $state = false)
    {
        $message = $state
            ? "Vous ne pouvez pas modifier la note de cet étudiant, car il a déjà été délibérer"
            : "Un étudiant ne peut pas être évalué deux fois dans un seul cours.";

        parent::__construct($message);
    }
}
