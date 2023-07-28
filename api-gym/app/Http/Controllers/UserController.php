<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function create(Request $req){
        $user = User::create($req->all());
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'cpf' => $user->cpf,
            'email' => $user->email,
            'ativo' => true,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }
}