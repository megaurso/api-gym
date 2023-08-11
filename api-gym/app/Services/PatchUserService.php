<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\GymPlan;
use App\Models\User;


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
            $data['ativo'] = true;
        }

        $user->fill($data);
        $user->save();

        $this->checkAndUpdatePlanValidity($user);

        $user->load('gymPlans');
        return $user;
    }


    private function checkAndUpdatePlanValidity(User $user)
    {
        $validityDays = 0;
        $currentPlan = $user->current_plan;
        $plan = GymPlan::find($currentPlan);

        if (!$plan) {
            throw new AppError('Plano não encontrado', 404);
        }

        switch ($plan->validity) {
            case 'Mensal':
                $validityDays = 30;
                break;
            case 'Trimestral':
                $validityDays = 90;
                break;
            case 'Semestral':
                $validityDays = 180;
                break;
            case 'Anual':
                $validityDays = 360;
                break;
            default:
                break;
        }

        $pivotData = $user->gymPlans->where('id', $currentPlan)->first();
        if ($pivotData && $pivotData->created_at) {
            $pivotCreatedAt = $pivotData->created_at;
            $today = now();
            $diffInDays = $today->diffInDays($pivotCreatedAt);

            if ($diffInDays >= $validityDays) {
                $user->ativo = false;
                $user->current_plan = null;
                $user->save();
            }
        }
    }
}
