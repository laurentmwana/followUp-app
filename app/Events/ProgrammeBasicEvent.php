<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class ProgrammeBasicEvent
{
    use SerializesModels;

    public function __construct(
        public string $programmeId,
        public string $semesterId
    ) {}
}
