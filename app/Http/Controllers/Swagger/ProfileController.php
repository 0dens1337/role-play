<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class ProfileController extends Controller
{
    #[OA\Get(
        path: "/api/profile/me",
        summary: "Список пользователей",
        security: [['BearerAuth' => []]],
        tags: ["Profile"],
        responses: [
            new OA\Response(response: 200, description: "Профиль Auth пользователя", content: new OA\JsonContent(ref: '#/components/schemas/ShowUserResource'))
        ]
    )]
    public function me(){}

    #[OA\Post(
        path: "/api/profile/upload-avatar",
        description: "Позволяет загрузить аватар пользователя. Поддерживаются форматы: JPEG, PNG, WEBP.",
        summary: "Загрузка аватара пользователя",
        security: [['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            description: "Файл аватара",
            required: true,
            content: new OA\MediaType(
                mediaType: "multipart/form-data",
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(
                            property: "avatar",
                            description: "Файл изображения",
                            type: "string",
                            format: "binary"
                        )
                    ]
                )
            )
        ),
        tags: ["Profile"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Аватар успешно загружен",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Avatar uploaded successfully")
                    ]
                )
            ),
            new OA\Response(
                response: 401,
                description: "Не авторизован"
            ),
            new OA\Response(
                response: 422,
                description: "Ошибка валидации",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "errors",
                            properties: [
                                new OA\Property(
                                    property: "avatar",
                                    type: "array",
                                    items: new OA\Items(type: "string", example: "The avatar must be an image.")
                                )
                            ],
                            type: "object"
                        )
                    ]
                )
            ),
            new OA\Response(
                response: 500,
                description: "Ошибка сервера при обработке изображения"
            )
        ]
    )]
    public function uploadAvatar(){}
}
