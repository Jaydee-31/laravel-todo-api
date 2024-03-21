<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $validatedRequest = $request->validated();

        $email = $request['email'];
        $password = $request['password'];

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $token = $user->createToken('demo')->accessToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'error' => 'Unauthenticated'
        ],401);
    }

    /**
     * Revoke access token
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $user->token()->revoke();

        return response()->json([], 204);
    }
}
