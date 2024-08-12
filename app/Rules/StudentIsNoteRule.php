<?php

namespace App\Rules;

use App\Models\Deliberation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StudentIsNoteRule implements ValidationRule
{
    public function __construct(private array $input) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {}
}
