<?php

namespace App\Services\PlansServices;

use App\Models\GymPlan;
use App\Exceptions\AppError;

class PatchPlansService
{
    public function execute($id, array $data)
    {
        $gymPlan = GymPlan::find($id);

        if (!$gymPlan) {
            throw new AppError('Plano não encontrado', 404);
        }

        $gymPlan->fill($data);
        $gymPlan->save();

        return $gymPlan;
    }
}
