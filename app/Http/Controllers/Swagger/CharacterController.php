<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class CharacterController extends Controller
{
    #[OA\Get(
        path: "/api/characters/",
        summary: "Список персов",
        security: [['cookieAuth' => []]],
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
        security: [['cookieAuth' => []]],
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

    #[OA\Get(
        path: "/api/characters/{character}/show",
        summary: "Получить одного перса",
        security: [['cookieAuth' => []]],
        tags: ["Characters"],
        parameters: [
            new OA\Parameter(
                name: "character",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Информация о Персе",
                content: new OA\JsonContent(ref: "#/components/schemas/CharactersShowResource")
            ),
            new OA\Response(response: 404, description: "Character не найден")
        ]
    )]
    public function show(){}

    #[OA\Post(
        path: "/api/characters/create",
        summary: "Создание 'пустого' персонажа",
        security: [['cookieAuth' => []]],
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
        security: [['cookieAuth' => []]],
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
        security: [['cookieAuth' => []]],
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

    #[OA\Post(
        path: "/api/admin/characters/{character}/add-exp",
        summary: "Ручное добавление exp персонажу",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/AddExpRequest")
        ),
        tags: ["Characters"],
        parameters: [
            new OA\Parameter(name: "character", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "Exp was added successfully",
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function addExp(){}

    #[OA\Post(
        path: "/api/admin/characters/{character}/remove-exp",
        summary: "Ручное удаление exp персонажу",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/RemoveExpRequest")
        ),
        tags: ["Characters"],
        parameters: [
            new OA\Parameter(name: "character", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "Exp was removed successfully",
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function removeExp(){}

    #[OA\Delete(
        path: "/api/admin/characters/{character}/delete",
        summary: "Ручное Удаление перса",
        security: [['cookieAuth' => []]],
        tags: ["Characters"],
        parameters: [
            new OA\Parameter(name: "character", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "Перс удален",
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function delete(){}
}
