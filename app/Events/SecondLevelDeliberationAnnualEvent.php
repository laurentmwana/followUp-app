<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class SecondLevelDeliberationAnnualEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public string $programmeId,
        public string $optionId
    ) {}
}
