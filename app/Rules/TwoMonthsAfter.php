<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

class TwoMonthsAfter implements ValidationRule
{
    protected $startDateField;

    public function __construct($startDateField)
    {
        $this->startDateField = $startDateField;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $startDate = request()->input($this->startDateField);
        if ($startDate) {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($value);
            if ($endDate->lt($startDate->addMonths(2))) {
                $fail('La fecha de finalización debe ser al menos 2 meses después de la fecha de inicio.');
            }
        } else {
            $fail('La fecha de inicio es requerida para validar la fecha de finalización.');
        }
    }
}
