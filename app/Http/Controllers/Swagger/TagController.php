<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class TagController extends Controller
{
    #[OA\Get(
        path: "/api/tags/",
        summary: "Список тегов",
        security: [['cookieAuth' => []]],
        tags: ["Tags"],
        parameters: [
            new OA\Parameter(name: "without_paginate", in: "query", required: false, schema: new OA\Schema(type: "integer", default: 0)),
            new OA\Parameter(name: "per_page", in: "query", required: false, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список тегов",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/TagResource")
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Post(
        path: "/api/tags/create",
        summary: "Создать тег",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/StoreTagRequest")
        ),
        tags: ["Tags"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Тег успешно создан",
                content: new OA\JsonContent(ref: "#/components/schemas/TagResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}

    #[OA\Put(
        path: "/api/tags/{tag}/update",
        summary: "Обновить тег",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateTagRequest")
        ),
        tags: ["Tags"],
        parameters: [
            new OA\Parameter(
                name: "tag",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Тег обновлён",
                content: new OA\JsonContent(ref: "#/components/schemas/TagResource")
            ),
            new OA\Response(response: 404, description: "Тег не найден"),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function update(){}

    #[OA\Delete(
        path: "/api/tags/{tag}/delete",
        summary: "Удалить тег",
        security: [['cookieAuth' => []]],
        tags: ["Tags"],
        parameters: [
            new OA\Parameter(
                name: "tag",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Тег успешно удалён",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Tag deleted successfully")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: 404, description: "Тег не найден")
        ]
    )]
    public function delete(){}
}
