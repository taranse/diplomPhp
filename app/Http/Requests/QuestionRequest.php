<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
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
            'text' => 'required',
            'author' => 'required',
            'email' => 'required',
            'name' => 'required|unique:questions|max:100',
        ];
    }
    public function messages()
    {
        return [
            'text.required' => 'Введите текст вопроса',
            'author.required'  => 'Введите свое имя',
            'email.required'  => 'Введите свой email',
            'name.required'  => 'Вы должны вести название вопроса',
            'name.unique'  => 'Вопрос с таким названием уже существует',
            'name.max'  => 'Слишком длинное имя',
        ];
    }
}
