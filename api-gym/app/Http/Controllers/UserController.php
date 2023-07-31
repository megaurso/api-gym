<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Services\CreateUserService;


class UserController extends Controller {
    public function create(CreateUserRequest $req){
        $createUserServicee = new CreateUserService();

        return $createUserServicee->execute($req->all());
    }
}