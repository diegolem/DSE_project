<?php

namespace Ignite\Rules;

use Illuminate\Contracts\Validation\Rule;

class BirthdateValidation implements Rule
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
        $date1 = date_create($value);
        $date2 = date_create(date('Y').'-'.date('m').'-'.date('d'));

        $diff = date_diff($date1,$date2);

        return $diff->format('%y') != '0' && $diff->format('%y') >= 18;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El :attribute debe de tener mas tiempo.';
    }
}
