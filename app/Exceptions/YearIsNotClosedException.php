<?php

namespace App\Exceptions;

use Exception;

class YearIsNotClosedException extends Exception
{
    public function __construct(string $programmeId)
    {
        parent::__construct(
            "De que vous finissez la déliberation annuelle de toutes les promotions, vous devez cloturer l'année academique, vérifier l'année academique de la promotion Licence {$programmeId}."
        );
    }
}
