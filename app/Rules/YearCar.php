<?php

namespace Ignite\Rules;

use Illuminate\Contracts\Validation\Rule;

class YearCar implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $yearInput = (int) $value;
        $year = (int) (date('Y'));
        return ( (($yearInput - $year) > 1) ? false : true );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Año no puede ser mayor 2 veces que el actual.';
    }
}
