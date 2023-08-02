<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class PatchUserService
{
    public function execute($id, array $data)
    {
        $user = User::find($id);

        if (!$user) {
            throw new AppError('User não encontrado', 404);
        }

        $user->fill($data);
        $user->save();

        return $user;
    }
}
