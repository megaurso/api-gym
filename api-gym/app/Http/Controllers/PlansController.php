<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlansRequest;
use App\Http\Requests\PatchPlansRequest;
use App\Services\PlansServices\CreatePlansService;
use App\Services\PlansServices\DeletePlansService;
use App\Services\PlansServices\GetPlansService;
use App\Services\PlansServices\PatchPlansService;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function create(CreatePlansRequest $req)
    {
        $createPlansService = new CreatePlansService();
        return $createPlansService->execute($req->all());
    }

    public function getAll(Request $req)
    {
        $getPlansService = new GetPlansService();
        $perPage = $req->query('per_page', 5);
        $query = $getPlansService->getAll();
        $plans = $query->paginate($perPage);
        return response()->json([
            'data' => $plans->items(),
            'meta' => [
                'current_page' => $plans->currentPage(),
                'last_page' => $plans->lastPage(),
                'prev_page_url' => $plans->previousPageUrl(),
                'next_page_url' => $plans->nextPageUrl(),
                'per_page' => $plans->perPage(),
                'total' => $plans->total(),
            ],
        ], 200);
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
