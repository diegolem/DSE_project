<?php

namespace Ignite\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> array('required',
            'regex:/^([A-Z]|[a-z]|[ñÑ]|[áéíóúÁÉÍÓÚA])[ñÑa-záéíóúÁÉÍÓÚA-Z -]*$/'),
            'description'=> array('required',
            'regex:/^([A-Z]|[a-z]|[ñÑ]|[áéíóúÁÉÍÓÚA])[ñÑa-zA-ZáéíóúÁÉÍÓÚA0-9,. -]*$/')
        ];
    }
}
