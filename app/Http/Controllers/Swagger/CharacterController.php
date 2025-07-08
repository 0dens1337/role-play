<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class CharacterController extends Controller
{
    #[OA\Get(
        path: "/api/characters/",
        summary: "Список персов",
        security: [['BearerAuth' => []]],
        tags: ["Characters"],
        parameters: [
            new OA\Parameter(name: "without_paginate", in: "query", required: false, schema: new OA\Schema(type: "integer", default: 0)),
            new OA\Parameter(name: "per_page", in: "query", required: false, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список персов",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/CharactersResource")
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Get(
        path: "/api/characters/my-characters",
        summary: "Список персов",
        security: [['BearerAuth' => []]],
        tags: ["Characters"],
        parameters: [
            new OA\Parameter(name: "without_paginate", in: "query", required: false, schema: new OA\Schema(type: "integer", default: 0)),
            new OA\Parameter(name: "per_page", in: "query", required: false, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список персов",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/CharactersResource")
                )
            )
        ]
    )]
    public function authUserCharacters(){}

    #[OA\Post(
        path: "/api/characters/create",
        summary: "Создание 'пустого' персонажа",
        security: [['BearerAuth' => []]],
        tags: ["Characters"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Перс успешно создан",
                content: new OA\JsonContent(ref: "#/components/schemas/CharactersShowResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}

    #[OA\Post(
        path: "/api/characters/{character}/verification-data",
        summary: "Создание данных для проверки у персонажа",
        security: [['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/StoreCharacterReviewDataRequest")
        ),
        tags: ["Characters"],
        parameters: [
            new OA\Parameter(name: "character", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "Данные ушли на проверку",
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function createReviewData(){}

    #[OA\Post(
        path: "/api/characters/{character}/update-verification-data",
        summary: "Обновление данных для проверки у персонажа (уже созданного до этого)",
        security: [['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/StoreCharacterReviewDataRequest")
        ),
        tags: ["Characters"],
        parameters: [
            new OA\Parameter(name: "character", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "Данные ушли на проверку",
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function updateReviewData(){}
}
