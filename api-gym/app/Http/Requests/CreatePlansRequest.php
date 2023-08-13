<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreatePlansRequest",
 *     type="object",
 *     title="Create Plans Request",
 *     @OA\Property(property="name", type="string", description="Nome do plano"),
 *     @OA\Property(property="price", type="number", description="Preço do plano"),
 *     @OA\Property(property="validity", type="string", enum={"Mensal", "Trimestral", "Semestral", "Anual"}, description="Duração do plano")
 * )
 */
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
            'validity' => 'required|in:Mensal,Trimestral,Semestral,Anual',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é obrigatório',
            'price.required' => 'Preço é obrigatório',
            'validity.required' => 'Duração do plano obrigatória',
            'validity.in' => 'Plano precisa ser Mensal,Trimestral,Semestral ou Anual',
        ];
    }
}
