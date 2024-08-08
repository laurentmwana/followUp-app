<?php

namespace App\Rules;

use Closure;
use App\Models\Code;
use Illuminate\Contracts\Validation\ValidationRule;

class PhoneFormatRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (null !== $value && !empty($value)) {
            $size = strlen($value);
            if ($size < 10 || $size > 10) {
                $fail("{$attribute} doit avoir 10 chiffres");
            } else {
                $exists = Code::where('name', '=', substr($value, 0, 3))->exists();
                if (!$exists) {
                    $fail("{$attribute} n'est pas un numéro de téléphone de la RDC");
                }
            }
        }
    }
}
