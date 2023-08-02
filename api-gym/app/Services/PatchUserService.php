<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\GymPlan;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class PatchUserService
{
    public function execute($id, array $data)
    {
        $user = User::with('gymPlans')->find($id);

        if (!$user) {
            throw new AppError('User não encontrado', 404);
        }

        if ($user->plan_history === null) {
            $user->plan_history = [];
        }

        if (isset($data['current_plan'])) {
            $currentPlan = $data['current_plan'];
            $planExists = GymPlan::where('id', $currentPlan)->exists();
            if (!$planExists) {
                throw new AppError('Plano não encontrado', 404);
            }

            $plan = GymPlan::where('id', $currentPlan)->first();

            $user->gymPlans()->sync([]);
            $user->gymPlans()->attach($plan);

            $planHistory = $user->getAttribute('plan_history');
            $planHistory[] = $plan;
            $user->setAttribute('plan_history', $planHistory);
        }

        $user->fill($data);
        $user->save();

        $user->load('gymPlans');
        return $user;
    }
}
