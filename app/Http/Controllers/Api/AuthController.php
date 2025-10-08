<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\InviteCodeRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\RegisterUserResource;
use App\Models\InviteCode;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function validateInviteCode(InviteCodeRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $inviteCode = InviteCode::query()
            ->where('code', $validated['code'])->first();

        if (! $inviteCode || $inviteCode->isValid()) {
            return response()->json(['Не верный или уже использованный код'], 422);
        }

        $inviteCode->markUsed();

        return response()->json([
            'message' => 'Invite-code принят, можете переходить к регистрации / логину.',
        ])->cookie(
            'invite_code',
            encrypt($inviteCode->code),
            60 * 24,
            null,
            null,
            false,
            true,
        );
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::query()->create($request->validated());

        Auth::user($user);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Successfully registered!',
        ])->cookie(
            'auth_token',
            $token,
            config('sanctum.expiration', 60 * 24 * 7),
            null,
            null,
            false,
            true // HttpOnly
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();
        $user = User::query()->where('email', $request->email)->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'message' => 'Email или пароль не совпадают с нашими данными.',
            ], 401);
        }

        Auth::login($user);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Успешная авторизация.',
        ])->cookie(
            'auth_token',
            $token,
            config('sanctum.expiration', 60 * 24 * 7),
            null,
            null,
            false,
            true // HttpOnly
        );
    }

    public function logout()
    {
        Auth::logoutCurrentDevice();

        return response()->json(['message' => 'Успешный лог аут'])
            ->withoutCookie('auth_token');
    }
}
