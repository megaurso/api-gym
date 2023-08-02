<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class GetUsersService
{
    public function getAll()
    {
        return User::all();
    }

    public function getOne($id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new AppError('User não encontrado', 404);
        }
        return $user;
    }
}
