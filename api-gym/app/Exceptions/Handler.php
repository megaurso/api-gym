<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($req, Throwable $error)
    {

        if ($error instanceof AppError) {
            return response()->json([
                'errors' => $error->getMessage()
            ], $error->getCode());
        }

        if ($error instanceof AuthorizationException) {
            return response()->json([
                'errors' => $error->getMessage()
            ], 403);
        }

        if ($error instanceof NotFoundHttpException) {
            return response()->json([
                'errors' => "Rota não encontrada"
            ], 404);
        }

        if ($error instanceof ValidationException) {
            return response()->json([
                'errors' => $error->validator->errors()
            ], 422);
        }
        Log::error('Internal',[$error]);
        
        return response()->json([
            'message' => "Ocorreu um erro interno no servidor"
        ], 500);
    }
}
