<?php

namespace App\Enums;

enum DecisionEnum: string
{
    case DECISION_ADMITTED  = 'Admis';

    case DECISION_RETAKE  = 'Reprend';
}
