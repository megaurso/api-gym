<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateWorkingOutRequest;
use App\Models\User;
use App\Services\WorkingOutServices\CreateWorkingOutService;
use App\Services\WorkingOutServices\StopWorkingOutService;



class WorkingOutController extends Controller
{
    /**
     * @OA\Post(
     *     path="/working-out",
     *     summary="Registrar entrada para treino",
     *     tags={"Treino"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateWorkingOutRequest")
     *     ),
     *     @OA\Response(response="200", description="Aluno entrou para treinar"),
     * )
     */
    public function create(CreateWorkingOutRequest $request, CreateWorkingOutService $createWorkingOutService)
    {
        $data = $request->validated();
        $training = $createWorkingOutService->execute($data);

        $user = User::find($data['user_id']);
        $user->trainings()->save($training);

        return response()->json(['message' => 'Aluno entrou para treinar']);
    }


    /**
     * @OA\Delete(
     *     path="/working-out/{id}",
     *     summary="Concluir treino",
     *     tags={"Treino"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do treino"),
     *     @OA\Response(response="200", description="Treino concluído"),
     *     @OA\Response(response="404", description="Treino não encontrado"),
     * )
     */
    public function delete($id, StopWorkingOutService $stopWorkingOutService)
    {
        $stopWorkingOutService->execute($id);

        return response()->json(['message' => 'Treino concluído'], 200);
    }
}
