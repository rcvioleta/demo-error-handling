<?php

namespace App\Http\Controllers;

use App\Exceptions\Custom\XeroValidationException;
use App\Http\Services\XeroAccountService;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class XeroContactController extends Controller
{
    public function __construct(private XeroAccountService $xeroAccountService)
    {
        // ...
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->xeroAccountService->getAccounts();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ...
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        request()->validate([
            'email' => 'required|email',
            'age' => 'required|integer',
        ]);

        // Explicit error message
        // $user = User::find($id);

        // if (!$user) {
        //     throw new NotFoundHttpException(
        //         message: "User was not found",
        //         code: Response::HTTP_NOT_FOUND
        //     );
        // }

        // return $user;

        // Throw NotFoundHttpException automatically if record is not found.
        $user = User::findOrFail($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
