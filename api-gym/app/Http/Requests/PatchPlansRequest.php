<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatchPlansRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['sometimes', 'string'],
            'price' => ['sometimes', 'regex:/^\d+(\.\d{1,2})?$/'],
            'validity' => ['sometimes', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'O nome deve ser uma string',
            'price.regex' => 'O preço deve ser um valor numérico válido (pode conter até 2 casas decimais)',
            'validity.date' => 'A duração do plano deve ser uma string',
        ];
    }
}
