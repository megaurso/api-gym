<?php

namespace App\Services\PlansServices;

use App\Exceptions\AppError;
use App\Models\GymPlan;

class GetPlansService
{
    public function getAll()
    {
        return GymPlan::all()->toQuery();
    }

    public function getOne($id)
    {
        $plan = GymPlan::find($id);
        if (!$plan) {
            throw new AppError('Plano não encontrado', 404);
        }
        return $plan;
    }
}
