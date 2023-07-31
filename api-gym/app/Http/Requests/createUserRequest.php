<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createUserRequest extends FormRequest
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
            'email'=> ['required','email'],
            'name'=> ['required'],
            'cpf'=> ['required','min:11', 'max:11'],
            'password'=> ['required', 'min:7'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email é obrigatório',
            'email.email' => 'Email deve ser um endereço válido',
            'password.required' => 'Senha é obrigatória',
            'password.min' => 'Senha deve conter no minimo 7 caracteres',
            'name.required' => 'Nome é obrigatório',
            'cpf.required' => 'Cpf é obrigatório',
            'cpf.min' => 'Cpf deve conter 11 caracteres',
            'cpf.max' => 'Cpf deve conter 11 caracteres'
        ];
    }
}
