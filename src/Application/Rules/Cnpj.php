<?php

namespace Application\Rules;

use Closure;
use Illuminate\Contracts\Validation\InvokableRule;

class Cnpj implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (!$this->cnpjIsValid($value)) {
            $fail('validation.cnpj')->translate();
        }
    }

    private function cnpjIsValid(string $cnpj): bool
    {
        $cnpj = self::takeOnlyTheDigits($cnpj);

        if (14 != mb_strlen($cnpj)) {
            return false;
        }

        return self::checkIfTheCalculationIsValid($cnpj, position: 5)
            && self::checkIfTheCalculationIsValid($cnpj, position: 6);
    }

    private function takeOnlyTheDigits(string $cnpj): string
    {
        return preg_replace('/[^0-9]/', '', $cnpj);
    }

    private function checkIfTheCalculationIsValid(string $cnpj, int $position)
    {
        $digitToBeChecked = 5 == $position ? 12 : 13;

        for ($i = 0, $j = $position, $sum = 0; $i < $digitToBeChecked; ++$i) {
            $sum += $cnpj[$i] * $j;
            $j = (2 == $j) ? 9 : $j - 1;
        }

        $rest = $sum % 11;
        $rest = $rest < 2 ? 0 : 11 - $rest;

        return $cnpj[$digitToBeChecked] == $rest;
    }
}
