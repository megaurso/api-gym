<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\User;

class CreateUserService
{
    public function execute($data)
    {
        $userFound = User::firstWhere('email', $data['email']);

        if (!is_null($userFound)) {
            throw new AppError('Email já cadastrado', 400);
        };
        $userFound = User::firstWhere('cpf', $data['cpf']);

        if (!is_null($userFound)) {
            throw new AppError('Cpf já cadastrado', 400);
        };
        return User::create($data);
    }
}
