<?php

namespace App\Services\PlansServices;

use App\Models\GymPlan;

class CreatePlansService
{
    public function execute($data)
    {
        return GymPlan::create($data);
    }
}
