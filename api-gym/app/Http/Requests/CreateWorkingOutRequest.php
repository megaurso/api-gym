<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
