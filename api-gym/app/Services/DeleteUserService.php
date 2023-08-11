<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class DeleteUserService
{
    public function execute($id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new AppError('Usuário não encontrado', 404);
        }
        $user->delete();
    }
}
