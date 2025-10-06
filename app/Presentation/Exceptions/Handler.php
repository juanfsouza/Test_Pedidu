<?php

namespace App\Presentation\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Facades\Log;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     */
    public function render($request, Throwable $e): JsonResponse
    {
        if ($request->expectsJson()) {
            return $this->handleApiException($request, $e);
        }

        return parent::render($request, $e);
    }

    /**
     * Handle API exceptions with proper JSON responses.
     */
    private function handleApiException(Request $request, Throwable $e): JsonResponse
    {
        $statusCode = 500;
        $message = 'Erro interno do servidor';

        if ($e instanceof ValidationException) {
            $statusCode = 422;
            $message = 'Dados inválidos';
            return response()->json([
                'message' => $message,
                'errors' => $e->errors()
            ], $statusCode);
        }

        if ($e instanceof ModelNotFoundException) {
            $statusCode = 404;
            $message = 'Recurso não encontrado';
        }

        if ($e instanceof NotFoundHttpException) {
            $statusCode = 404;
            $message = 'Endpoint não encontrado';
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            $statusCode = 405;
            $message = 'Método não permitido';
        }

        if ($e instanceof \InvalidArgumentException) {
            $statusCode = 400;
            $message = $e->getMessage();
        }

        Log::error('API Exception: ' . $e->getMessage(), [
            'exception' => $e,
            'request' => $request->all(),
            'url' => $request->url(),
            'method' => $request->method()
        ]);

        return response()->json([
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }
}
