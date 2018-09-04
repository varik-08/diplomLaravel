<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postCreateCategory extends FormRequest
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
            'code'=>'required|max:191|unique:categories,code',
            'name'=>'required|max:191',
            'description' => 'max:191',
            'image'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Не забывайте ввести код категории!',
            'name.required' => 'Не забывайте ввести наименование категории!',
            'image.required' => 'Не забывайте добавить фотографию!',
            'code.unique' => 'Такой код уже существует!',
            'code.max'=> 'Максимальная длина кода = 191 символ!',
            'description.max' => 'Максимальная длина описания = 191 символ!',
            'name.max'=> 'Максимальная длина наименования = 191 символ!',
        ];
    }
}
