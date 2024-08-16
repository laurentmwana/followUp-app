<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class DeliberationAnnualEvent
{
    use SerializesModels;

    public function __construct(
        public string $programmeId,
    ) {}
}
