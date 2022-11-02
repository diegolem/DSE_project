<?php

namespace Ignite\Rules;

use Illuminate\Contracts\Validation\Rule;

class License implements Rule
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
        return preg_match("/^((O|CD|CC|MI|N|PNC|E|P|A|C|V|PR|T|RE|AB|MB|F|M|D)\d{3})(-?)((\s\d{3})|\d{3})$/", $value, $coincidencias);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El formato para la matrícula no es válido.';
    }
}
