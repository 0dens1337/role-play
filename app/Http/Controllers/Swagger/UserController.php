<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Tag(name: "Users", description: "Управление пользователями")]
class UserController extends Controller
{
    #[OA\Get(
        path: "/api/users/",
        summary: "Список пользователей",
        security: [['BearerAuth' => []]],
        tags: ["Users"],
        parameters: [
            new OA\QueryParameter(name: "login", description: "Фильтр по login", required: false, schema: new OA\Schema(type: "string")),
            new OA\QueryParameter(name: "per_page", description: "Кол-во на страницу", required: false, schema: new OA\Schema(type: "integer", default: 10)),
            new OA\QueryParameter(name: "without_paginate", description: "Без пагинации", required: false, schema: new OA\Schema(type: "integer", default: 0))
        ],
        responses: [
            new OA\Response(response: 200, description: "Список пользователей", content: new OA\JsonContent(ref: '#/components/schemas/UserResource'))
        ]
    )]
    public function index() {}

    #[OA\Get(
        path: "/api/users/{id}/show",
        summary: "Получить пользователя",
        security: [['BearerAuth' => []]],
        tags: ["Users"],
        parameters: [
            new OA\PathParameter(name: "id", description: "ID пользователя", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Пользователь", content: new OA\JsonContent(ref: '#/components/schemas/UserResource')),
            new OA\Response(response: 404, description: "Пользователь не найден")
        ]
    )]
    public function show() {}

    #[OA\Post(
        path: "/api/users/store",
        summary: "Создать пользователя",
        security: [['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/StoreUserRequest')
        ),
        tags: ["Users"],
        responses: [
            new OA\Response(response: 201, description: "Создан", content: new OA\JsonContent(ref: '#/components/schemas/UserResource')),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function store() {}

    #[OA\Put(
        path: "/api/users/{id}/update",
        summary: "Обновить пользователя",
        security: [['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UpdateUserRequest')
        ),
        tags: ["Users"],
        parameters: [
            new OA\PathParameter(name: "id", description: "ID пользователя", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 200, description: "Обновлён", content: new OA\JsonContent(ref: '#/components/schemas/UserResource')),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function update() {}

    #[OA\Delete(
        path: "/api/users/{id}/delete",
        summary: "Удалить пользователя",
        security: [['BearerAuth' => []]],
        tags: ["Users"],
        parameters: [
            new OA\PathParameter(name: "id", description: "ID пользователя", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(response: 204, description: "Удалён"),
            new OA\Response(response: 404, description: "Пользователь не найден")
        ]
    )]
    public function delete() {}
}
