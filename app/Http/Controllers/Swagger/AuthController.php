<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    #[OA\Post(
        path: "/api/auth/register",
        summary: "Регистрация нового пользователя",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/RegisterRequest")
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Успешная регистрация",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "email", type: "string", example: "user@example.com"),
                        new OA\Property(property: "login", type: "string", example: "username"),
                        new OA\Property(property: "token", type: "string", example: "1|XxXxXxXx...")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function register(){}

    #[OA\Post(
        path: "/api/auth/login",
        summary: "Авторизация пользователя",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/LoginRequest")
        ),
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Успешная авторизация",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "email", type: "string", example: "user@example.com"),
                        new OA\Property(property: "login", type: "string", example: "username"),
                        new OA\Property(property: "token", type: "string", example: "1|XxXxXxXx...")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: 401, description: "Неверные данные")
        ]
    )]
    public function login(){}

    #[OA\Post(
        path: "/api/auth/logout",
        summary: "Выход из системы",
        security: [['cookieAuth' => []]],
        tags: ["Auth"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Успешный выход",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Successfully logged out")
                    ],
                    type: "object"
                )
            )
        ]
    )]
    public function logout(){}
}
