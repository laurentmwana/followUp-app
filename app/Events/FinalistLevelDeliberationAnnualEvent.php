<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class FinalistLevelDeliberationAnnualEvent
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
