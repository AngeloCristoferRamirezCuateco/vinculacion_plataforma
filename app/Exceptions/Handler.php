<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\QueryException;
use Throwable;

class Handler extends ExceptionHandler
{
    
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->renderable(function (QueryException $e, $request) {
            if ($e->getCode() === 'HY000' || $e->getCode() === '2002') {
                // El código de error 2002 es específico de MySQL cuando no puede conectar con la base de datos
                return response()->view('errors.database-error', [], 500);
            }
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof QueryException || $exception instanceof \PDOException) {
            // Puedes personalizar la respuesta para excepciones de base de datos
            return response()->view('errors.database', [], 500);
        }

        return parent::render($request, $exception);
    }
}
