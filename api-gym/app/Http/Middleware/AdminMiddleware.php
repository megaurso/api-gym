<?php

namespace App\Http\Middleware;

use App\Exceptions\AppError;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user || !$user->isAdmin) {
            throw new AppError('Acesso não autorizado.', 403);
        }

        return $next($request);
    }
}
