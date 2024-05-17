<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class validateUserType implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Verificar si el valor es 'A' o 'B'
        if ($value !== 'A' && $value !== 'B') {
            $fail('Tipo de usuario no válido, intenta de nuevo');
        }
    }
}
