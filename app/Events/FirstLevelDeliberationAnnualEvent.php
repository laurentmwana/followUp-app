<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class FirstLevelDeliberationAnnualEvent
{
    use SerializesModels;

    public function __construct(
        public string $programmeId,
        public string $optionId,
    ) {}
}
