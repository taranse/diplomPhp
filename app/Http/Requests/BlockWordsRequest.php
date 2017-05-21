<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockWordsRequest extends FormRequest
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
            'word' => 'required|unique:block_words|max:255',
            'author' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'word.required' => 'Название должно быть заполнено',
            'author.required'  => 'Алиас должен быть заполнен',
            'word.max' => 'Слишком длинное навзвание',
            'word.unique' => 'Такое слово или словосочетание уже существует',
        ];
    }
}
