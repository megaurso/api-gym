<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlansRequest;
use App\Http\Requests\PatchPlansRequest;
use App\Services\PlansServices\CreatePlansService;
use App\Services\PlansServices\DeletePlansService;
use App\Services\PlansServices\GetPlansService;
use App\Services\PlansServices\PatchPlansService;

class PlansController extends Controller
{
    public function create(CreatePlansRequest $req)
    {
        $createPlansService = new CreatePlansService();
        return $createPlansService->execute($req->all());
    }

    public function getAll()
    {
        $getPlansService = new GetPlansService();
        $plans = $getPlansService->getAll();
        return response()->json($plans, 200);
    }

    public function getOne($id)
    {
        $getPlansService = new GetPlansService();
        $plan = $getPlansService->getOne($id);

        return response()->json($plan, 200);
    }

    public function patch($id, PatchPlansRequest $request)
    {
        $patchPlansService = new PatchPlansService();
        $data = $request->all();
        $updatedPlan = $patchPlansService->execute($id, $data);
        return response()->json($updatedPlan, 200);
    }


    public function delete($id)
    {
        $deletePlansService = new DeletePlansService();
        $deletePlansService->execute($id);
        return response()->json(null, 204);
    }
}
