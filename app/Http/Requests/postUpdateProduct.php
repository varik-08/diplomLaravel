<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class postUpdateProduct extends FormRequest
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
            'code'=>'required|max:191|unique:products,code,'  . $this->segment(3),
            'name'=>'required|max:191',
            'category_id'=>'required',
            'description' => 'max:191',
            'price'=>'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Не забывайте ввести код товара!',
            'name.required' => 'Не забывайте ввести наименование товара!',
            'category_id.required' => 'Не забывайте выбрать категорию товара!',
            'price.required' => 'Не забывайте ввести цену товара!',
            'code.unique' => 'Такой код уже существует!',
            'code.max'=> 'Максимальная длина кода = 191 символ!',
            'name.max'=> 'Максимальная длина наименования = 191 символ!',
            'description.max' => 'Максимальная длина описания = 191 символ!',
            'price.numeric' => 'Цена должна состоять из чисел!',
            'price.min' => 'Цена не может быть  меньше 0!',
        ];
    }
}
