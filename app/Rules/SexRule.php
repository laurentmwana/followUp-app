<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SexRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $keys = array_keys(ARRAY_SEXIES);
        if (null !== $value && !empty($value) && !in_array($value, $keys)) {
            $fail("{$attribute} n'est pas valide");
        }
    }
}
