<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     title="CreateUserRequest",
 *     description="Request schema for creating a user",
 *     required={"email", "name", "cpf", "password", "phone"},
 *     @OA\Property(property="email", type="string", example="user@example.com"),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="cpf", type="string", example="12345678901"),
 *     @OA\Property(property="password", type="string", example="password123"),
 *     @OA\Property(property="phone", type="string", example="12345678"),
 * )
 */
class CreateUserRequest extends FormRequest
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
            'phone'=> ['required','min:8']
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
            'cpf.max' => 'Cpf deve conter 11 caracteres',
            'phone.required'=>'Telefone é obrigatório',
            'phone.min' => 'Telefone deve conter no minimo 8 dígitos'
        ];
    }
}
