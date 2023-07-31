<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'=> 'required',
            'password'=> 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email deve ser um endereço válido',
            'password.required' => 'Senha é obrigatória',
            'password.min' => 'Senha deve conter no minimo 7 caracteres',
        ];
    }
}
