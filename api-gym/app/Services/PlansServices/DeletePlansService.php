<?php

namespace App\Services\PlansServices;

use App\Exceptions\AppError;
use App\Models\GymPlan;

class DeletePlansService
{
    public function execute($id)
    {
        $gymPlan = GymPlan::find($id);
        if (!$gymPlan) {
            throw new AppError('Plano não encontrado', 404);
        }
        $gymPlan->delete();
    }
}
