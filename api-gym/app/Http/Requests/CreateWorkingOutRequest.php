<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateWorkingOutRequest",
 *     type="object",
 *     title="Create Working Out Request",
 *     required={"user_id"},
 *     @OA\Property(property="user_id", type="integer", description="ID do usuário"),
 * )
 */
class CreateWorkingOutRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => ['required'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'user_id é obrigatório',
        ];
    }
}
