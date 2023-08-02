<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatchUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['sometimes', 'string', 'email'],
            'name' => ['sometimes', 'string', 'max:255'],
            'cpf' => ['sometimes', 'string', 'max:14'], 
            'password' => ['sometimes', 'string', 'min:6'],
            'phone' => ['sometimes', 'string', 'max:20'], 
            'isAdmin' => ['sometimes', 'boolean'],
            'current_plan' => ['sometimes', 'string', 'max:255'],
            
        ];
    }

    public function messages(): array
    {
        return [
            'email.string' => 'O email deve ser uma string',
            'name.string' => 'O nome deve ser uma string',
            'cpf.string' => 'O cpf deve ser uma string',
            'password.string' => 'O password deve ser uma string',
            'phone.string' => 'O numero deve ser uma string',
            'isAdmin.boolean' => 'Deve ter true ou false',
        ];
    }
}
