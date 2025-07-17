<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class CharacterMetaController extends Controller
{
    #[OA\Post(
        path: "/api/characters/add-meta",
        summary: "Создание 'пустого' персонажа",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/StoreCharacterMetaRequest")
        ),
        tags: ["CharacterMeta"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Перс успешно создан",
                content: new OA\JsonContent(ref: "#/components/schemas/CharacterMetaResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}
}
