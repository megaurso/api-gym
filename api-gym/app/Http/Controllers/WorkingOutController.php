<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkingOutRequest;
use App\Models\User;
use App\Services\WorkingOutServices\CreateWorkingOutService;
use App\Services\WorkingOutServices\StopWorkingOutService;

class WorkingOutController extends Controller
{
    public function create(CreateWorkingOutRequest $request, CreateWorkingOutService $createWorkingOutService)
    {
        $data = $request->validated();
        $training = $createWorkingOutService->execute($data);

        $user = User::find($data['user_id']);
        $user->trainings()->save($training);

        return response()->json(['message' => 'Aluno entrou para treinar']);
    }

    public function delete($id, StopWorkingOutService $stopWorkingOutService)
    {
        $stopWorkingOutService->execute($id);

        return response()->json(['message' => 'Treino concluído'], 200);
    }
}
