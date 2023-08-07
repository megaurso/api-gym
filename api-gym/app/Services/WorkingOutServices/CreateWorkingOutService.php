<?php

namespace App\Services\WorkingOutServices;

use App\Exceptions\AppError;
use App\Models\Training;
use App\Models\User;

class CreateWorkingOutService
{
    public function execute($data)
    {
        $user = User::find($data['user_id']);

        if (!$user) {
            throw new AppError('Usuário não encontrado.', 404);
        }

        $existingTraining = Training::where('user_id', $user->id)
            ->whereNull('horario_saida')
            ->first();

        if ($existingTraining) {
            throw new AppError('Usuário já possui um treino em andamento.', 400);
        }

        if (!$user->ativo) {
            throw new AppError('Usuário sem plano ou atrasado. Verifique situação com o financeiro', 403);
        }

        
        $data['horario_entrada'] = now();

        $training = Training::create($data);

        return $training;
    }
}
