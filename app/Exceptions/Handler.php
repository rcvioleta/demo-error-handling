<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ExceptionCallback;

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
     * Indicates that an exception instance should only be reported once.
     *
     * @var bool
     */
    protected $withoutDuplicates = true;

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // Symfony\Component\Mailer\Exception\TransportException

        $this->renderable(function (\Throwable $e, Request $request) {
            if ($request->wantsJson() || $request->expectsJson() || $request->isJson()) {
                $statusCode = is_int($e->getCode()) && $e->getCode() != 0
                    ? $e->getCode()
                    : Response::HTTP_BAD_REQUEST;

                $message = $e->getMessage();
                $errors = [];

                if ($e instanceof NotFoundHttpException) {
                    $message = 'The specified URL or resource was not found.';
                } elseif ($e instanceof ValidationException) {
                    $statusCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                    $errors = $e->validator->errors();
                }

                return response()->json([
                    'message' => $message,
                    'errors' => $errors
                ], $statusCode);
            }
        });
    }
}
