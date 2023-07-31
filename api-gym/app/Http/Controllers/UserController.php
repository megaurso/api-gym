<?php

namespace App\Http\Controllers;

use App\Http\Requests\createUserRequest;
use App\Services\CreateUserService;


class UserController extends Controller {
    public function create(createUserRequest $req){
        $createUserServicee = new CreateUserService();

        return $createUserServicee->execute($req->all());
    }
}