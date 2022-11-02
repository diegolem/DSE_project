<?php

namespace Ignite\Rules;

use Illuminate\Contracts\Validation\Rule;
use Ignite\User;

class Dui implements Rule
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
        return preg_match("/^[0-9]{8}-[0-9]$/", $value, $coincidencias);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El dui debe de poseer el formato xxxxxxxx-x';
    }
}
