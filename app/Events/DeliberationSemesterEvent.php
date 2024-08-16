<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class DeliberationSemesterEvent
{
    use SerializesModels;

    public function __construct(
        public string $programmeId,
        public string $semesterId,
        public ?string $optionId = null,
    ) {}
}
