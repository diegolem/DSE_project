<?php

namespace Ignite\Rules;

use Illuminate\Contracts\Validation\Rule;
use Ignite\User;

class DuiExistEditRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $id = 0;

    public function __construct($id)
    {
        $this->id = (int)$id;
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
        return User::where('dui', '=', ''.$value)->where("id", "!=", $this->id)->doesntExist();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El dui ingresado ya existe';
    }
}
