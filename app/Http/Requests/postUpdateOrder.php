<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postUpdateOrder extends FormRequest
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
            'name'=>'required|max:191',
            'phone'=>'required|max:191|regex:/^\+?7?\d{10}$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не забывайте ввести имя!',
            'phone.required' => 'Не забывайте ввести телефон!',
            'name.max'=> 'Максимальная длина имени = 191 символ!',
            'phone.max'=> 'Максимальная длина наименования = 191 символ!',
            'phone.regex' => 'Некоректный номер',
        ];
    }
}
