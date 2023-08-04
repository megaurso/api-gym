<?php

namespace App\Services\WorkingOutServices;

use App\Exceptions\AppError;
use App\Models\Training;

class StopWorkingOutService
{
    public function execute($id)
    {
        $training = Training::find($id);
        if (!$training) {
            throw new AppError('Treino não encontrado.', 404);
        }

        $training->horario_saida = now();
        $training->save();
    }
}
