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

    /**
     * @OA\Post(
     *     path="/plans",
     *     summary="Criar um novo plano",
     *     tags={"Planos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/CreatePlansRequest"
     *             ),
     *             @OA\Examples(example="Example Request Body", value={
     *                 "name": "Plano Mensal",
     *                 "price": 29.99,
     *                 "validity": "Mensal"
     *             }, summary="Exemplo de corpo de requisição")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Plano criado"),
     * )
     */
    public function create(CreatePlansRequest $req)
    {
        $createPlansService = new CreatePlansService();
        return $createPlansService->execute($req->all());
    }

    /**
     * @OA\Get(
     *     path="/plans",
     *     summary="Obter lista de planos",
     *     tags={"Planos"},
     *     @OA\Response(response="200", description="Lista de planos"),
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/plans/{id}",
     *     summary="Obter plano por ID",
     *     tags={"Planos"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do plano"),
     *     @OA\Response(response="200", description="Plano encontrado"),
     *     @OA\Response(response="404", description="Plano não encontrado"),
     * )
     */
    public function getOne($id)
    {
        $getPlansService = new GetPlansService();
        $plan = $getPlansService->getOne($id);

        return response()->json($plan, 200);
    }

  /**
     * @OA\Patch(
     *     path="/plans/{id}",
     *     summary="Atualizar plano",
     *     tags={"Planos"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do plano"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/CreatePlansRequest"
     *             ),
     *             @OA\Examples(example="Example Request Body", value={
     *                 "name": "Plano Trimestral",
     *                 "price": 75.0,
     *                 "validity": "Trimestral"
     *             }, summary="Exemplo de corpo de requisição")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Plano atualizado"),
     *     @OA\Response(response="404", description="Plano não encontrado"),
     * )
     */
    public function patch($id, PatchPlansRequest $request)
    {
        $patchPlansService = new PatchPlansService();
        $data = $request->all();
        $updatedPlan = $patchPlansService->execute($id, $data);
        return response()->json($updatedPlan, 200);
    }


    /**
     * @OA\Delete(
     *     path="/plans/{id}",
     *     summary="Excluir plano",
     *     tags={"Planos"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do plano"),
     *     @OA\Response(response="204", description="Plano excluído"),
     *     @OA\Response(response="404", description="Plano não encontrado"),
     * )
     */
    public function delete($id)
    {
        $deletePlansService = new DeletePlansService();
        $deletePlansService->execute($id);
        return response()->json(null, 204);
    }
}
