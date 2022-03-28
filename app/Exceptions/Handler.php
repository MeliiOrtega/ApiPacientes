<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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

    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'message' => __('Los datos proporcionados no son válidos.'),
            'errors' => $exception->errors(),
        ], $exception->status);
    }

    public function render($request, Throwable $exception)
    //CUANDO NO SE ENCUENTRE EL MODELO, NOS DEVUELVA LA RESPUESTA JSON
    {
        if($exception instanceof ModelNotFoundException){
            return response()->json(["res" => false, "error" => "Error modelo no encontrado"], 400);
        }
        if($exception instanceof RouteNotFoundException){
            return response()->json(["res" => false, "error" => "No tiene autorización"], 400);
        }
        return parent::render($request, $exception); //retornar la respuesta y no mucho texto
    }
}
