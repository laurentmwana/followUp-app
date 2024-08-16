<?php

namespace App\Rules;

use Closure;
use App\Models\Group;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxCreditGroupRule implements ValidationRule
{
    public function __construct(private array $data) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $group = Group::with(['courses'])
            ->find($this->data['group_id']);

        if ($group !== null) {
            $coursesCredits = $group->courses()->sum('credits');
            $limit = $coursesCredits + (int)$value;
            $r = $group->credits - $coursesCredits;
            if ($limit > $group->credits) {
                $fail("Il reste que {$r} crédit(s) sur {$group->credits} crédit(s)");
            }
        }
    }
}
