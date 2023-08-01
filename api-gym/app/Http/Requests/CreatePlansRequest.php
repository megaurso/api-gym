<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlansRequest extends FormRequest
{
   
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=> ['required'],
            'price'=> ['required'],
            'validity'=> ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'price.required' => 'Preço é obrigatório',
            'validity.required' => 'Duração do plano obrigatória',
        ];
    }
}
