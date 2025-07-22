<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class CharacterMetaController extends Controller
{
    #[OA\Post(
        path: "/api/characters/{character}/add-meta",
        summary: "Создание мета данных персонажа",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/StoreCharacterMetaRequest")
        ),
        tags: ["CharacterMeta"],
        parameters: [
            new OA\Parameter(name: "character", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "Мета успешно создана",
                content: new OA\JsonContent(ref: "#/components/schemas/CharacterMetaResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}

    #[OA\Patch(
        path: "/api/characters/{character}/update-meta",
        summary: "Обновление мета данных персонажа",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateCharacterMetaRequest")
        ),
        tags: ["CharacterMeta"],
        parameters: [
            new OA\Parameter(name: "character", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "Мета успешно создана",
                content: new OA\JsonContent(ref: "#/components/schemas/CharacterMetaResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function update(){}
}
