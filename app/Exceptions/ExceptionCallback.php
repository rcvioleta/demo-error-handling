<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionCallback
{
    protected function handleModelNotFoundException(ModelNotFoundException $e, Request $request)
    {
        if ($this->isJsonRequest($request)) {
            return response(
                content: 'The record was not found',
                status: Response::HTTP_NOT_FOUND
            );
        }

        return view('errors.web', [
            'title' => 'The record was not found',
            'message' => '',
            'code' => Response::HTTP_NOT_FOUND
        ]);
    }

    protected function handleNotFoundHttpException(NotFoundHttpException $e, Request $request)
    {
        if ($this->isJsonRequest($request)) {
            return response(
                content: $e->getMessage(),
                status: Response::HTTP_NOT_FOUND
            );
        }

        return view('errors.web', [
            'title' => $e->getMessage(),
            'message' => '',
            'code' => Response::HTTP_NOT_FOUND
        ]);
    }

    private function isJsonRequest(Request $request): bool
    {
        return $request->wantsJson() || $request->expectsJson() || $request->isJson();
    }
}
