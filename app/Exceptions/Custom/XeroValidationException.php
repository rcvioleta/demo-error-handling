<?php

namespace App\Exceptions\Custom;

use App\Models\ErrorLog;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class XeroValidationException extends \Exception
{
    private $assocError;

    public function __construct(
        private string $errorID,
        private \Exception $exception
    ) {
        // ...
    }

    public function report()
    {
        if ($this->exception instanceof ClientException) {
            $response = $this->exception->getResponse();
            $error = [];

            if ($response && $response->getBody()) {
                $errorData = $response->getBody()->getContents();
                $this->assocError = json_decode($errorData, true);
                $error = $this->assocError;
            }

            // Log::error('XERO_VALIDATION_EXCEPTION', [
            //     'message' => $this->exception->getMessage(),
            //     'error' => print_r($error, true)
            // ]);

            ErrorLog::create([
                'error_id' => 'XERO_VALIDATION_EXCEPTION',
                'message' => $this->exception->getMessage(),
                'errors' => $errorData
            ]);
        } else {
            // Log::error('XERO_VALIDATION_EXCEPTION', [
            //     'message' => $this->exception->getMessage()
            // ]);

            ErrorLog::create([
                'error_id' => 'XERO_API_ERROR',
                'message' => $this->exception->getMessage()
            ]);
        }
    }

    public function render(Request $request)
    {
        $statusCode = $this->exception->getCode();

        if ($this->exception instanceof ClientException) {
            $message = ucwords(str_replace('_', ' ', Str::snake($this->assocError['Detail'])));
            $errors = $this->assocError['Errors'] ?? [];

            if ($this->isJsonRequest($request)) {
                return response()->json([
                    'message' => $message,
                    'errors' => $errors
                ], $statusCode);
            }
        }

        return view('errors.web', [
            'title' => $this->exception->getMessage(),
            'message' => '',
            'code' => $statusCode
        ]);
    }

    private function isJsonRequest(Request $request): bool
    {
        return $request->wantsJson() || $request->expectsJson() || $request->isJson();
    }
}
