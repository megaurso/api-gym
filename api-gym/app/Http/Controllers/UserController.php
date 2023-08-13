<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\PatchUserRequest;
use App\Services\CreateUserService;
use App\Services\DeleteUserService;
use App\Services\GetUsersService;
use App\Services\PatchUserService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API da Academia",
 *     version="1.0",
 *     description="API para criar, listar, obter detalhes, atualizar e excluir usuários,planos e treinos."
 * )
 */

class UserController extends Controller
{

    /**
     * @OA\Post(
     *     path="/users",
     *     summary="Criar um novo usuário",
     *     tags={"Usuários"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/CreateUserRequest"
     *             )
     *         ),
     *         @OA\Examples(example="Example Request Body", value={
     *             "email": "user@example.com",
     *             "name": "John Doe",
     *             "cpf": "12345678901",
     *             "password": "password123",
     *             "phone": "12345678"
     *         })
     *     ),
     *     @OA\Response(response="201", description="Usuário criado"),
     * )
     */
    public function create(CreateUserRequest $req)
    {
        $createUserServicee = new CreateUserService();

        return $createUserServicee->execute($req->all());
    }

    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Obter lista de usuários",
     *     tags={"Usuários"},
     *     @OA\Response(response="200", description="Lista de usuários"),
     * )
     */
    public function getAll(Request $req)
    {
        $getUsersService = new GetUsersService();
        $perPage = $req->query('per_page', 5);
        $query = $getUsersService->getAll();
        $users = $query->paginate($perPage);
        return response()->json([
            'data' => $users->items(),
            'paginate' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'prev_page_url' => $users->previousPageUrl(),
                'next_page_url' => $users->nextPageUrl(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
            ],
        ], 200);
    }

    /**
     * @OA\Get(
     *     path="/users/{id}",
     *     summary="Obter usuário por ID",
     *     tags={"Usuários"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do usuário"),
     *     @OA\Response(response="200", description="Usuário encontrado"),
     *     @OA\Response(response="404", description="Usuário não encontrado"),
     * )
     */
    public function getOne($id)
    {
        $getUserService = new GetUsersService();
        $user = $getUserService->getOne($id);
        return response()->json($user, 200);
    }
    /**
     * @OA\Patch(
     *     path="/users/{id}",
     *     summary="Atualizar usuário",
     *     tags={"Usuários"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do usuário"),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 ref="#/components/schemas/CreateUserRequest"
     *             )
     *         ),
     *         @OA\Examples(example="Example Request Body", value={
     *             "email": "user@example.com",
     *             "name": "John Doe",
     *             "cpf": "12345678901",
     *             "password": "password123",
     *             "phone": "12345678"
     *         })
     *     ),
     *     @OA\Response(response="200", description="Usuário atualizado"),
     *     @OA\Response(response="404", description="Usuário não encontrado"),
     * )
     */
    public function patch($id, PatchUserRequest $req)
    {
        $patchUserService = new PatchUserService();
        $data = $req->all();
        $updatedUser = $patchUserService->execute($id, $data);
        return response()->json($updatedUser, 200);
    }

    /**
     * @OA\Delete(
     *     path="/users/{id}",
     *     summary="Excluir usuário",
     *     tags={"Usuários"},
     *     @OA\Parameter(name="id", in="path", required=true, description="ID do usuário"),
     *     @OA\Response(response="204", description="Usuário excluído"),
     *     @OA\Response(response="404", description="Usuário não encontrado"),
     * )
     */
    public function delete($id)
    {
        $deleteUserService = new DeleteUserService();
        $deleteUserService->execute($id);
        return response()->json(null, 204);
    }
}
