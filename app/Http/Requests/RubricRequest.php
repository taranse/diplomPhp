<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RubricRequest extends FormRequest
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
            'name' => 'required|max:255',
            'alias' => 'required|unique:rubrics|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название должно быть заполнено',
            'alias.required'  => 'Алиас должен быть заполнен',
        ];
    }
}
