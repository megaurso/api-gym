<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\PatchUserRequest;
use App\Services\CreateUserService;
use App\Services\DeleteUserService;
use App\Services\GetUsersService;
use App\Services\PatchUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(CreateUserRequest $req)
    {
        $createUserServicee = new CreateUserService();

        return $createUserServicee->execute($req->all());
    }

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

    public function getOne($id)
    {
        $getUserService = new GetUsersService();
        $user = $getUserService->getOne($id);
        return response()->json($user, 200);
    }

    public function patch($id, PatchUserRequest $req)
    {
        $patchUserService = new PatchUserService();
        $data = $req->all();
        $updatedUser = $patchUserService->execute($id, $data);
        return response()->json($updatedUser, 200);
    }

    public function delete($id)
    {
        $deleteUserService = new DeleteUserService();
        $deleteUserService->execute($id);
        return response()->json(null, 204);
    }
}
