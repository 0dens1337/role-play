<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\RegisterUserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::query()->create($request->validated());
        $token = $user->createToken('authToken')->accessToken;

        $cookie = cookie(
            'auth_token', // имя куки
            $token,      // значение
            60 * 24 * 7,  // срок действия в минутах (7 дней)
            null,         // путь
            null,         // домен
            true,         // secure (только HTTPS)
            true,         // httpOnly
            false,        // sameSite
            'lax'         // sameSite значение
        );

        return response()->json([
            'email' => $user->email,
            'login' => $user->login,
        ])->withCookie($cookie);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $user = User::query()
            ->where('email', $credentials['email'])
            ->first();

        if (! Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $token = $user->createToken('authToken')->accessToken;

        $cookie = cookie(
            'auth_token',
            $token,
            60 * 24 * 7,
            null,
            null,
            true,
            true,
            false,
            'lax'
        );

        return response()->json([
            'email' => $user->email,
            'login' => $user->login,
        ])->withCookie($cookie);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->token()->delete();

        $cookie = cookie()->forget('auth_token');

        return response()->json(['message' => 'Successfully logged out'])->withCookie($cookie);
    }

}
