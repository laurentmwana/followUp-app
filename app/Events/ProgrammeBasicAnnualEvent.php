<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ProgrammeBasicAnnualEvent
{
    use SerializesModels;

    public function __construct(
        public string $programmeId
    ) {}
}
