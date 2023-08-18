<?php

namespace App\Services\WorkingOutServices;

use App\Exceptions\AppError;
use App\Models\Training;
use App\Models\User;

class StopWorkingOutService
{
    public function execute($id)
    {
        $training = Training::find($id);
        if (!$training) {
            throw new AppError('Treino não encontrado.', 404);
        }

        $user = User::find($training->user_id);
        if ($user) {
            $training->horario_saida = now();
            $training->save();
            $training->user->update(['working_out' => false]);
        }
    }
}
