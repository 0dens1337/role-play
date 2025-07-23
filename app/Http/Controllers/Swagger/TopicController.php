<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use OpenApi\Attributes as OA;

class TopicController extends Controller
{
    #[OA\Get(
        path: "/api/admin/topics/",
        summary: "Список Обсуждения для Админов",
        security: [['cookieAuth' => []]],
        tags: ["Topics"],
        parameters: [
            new OA\Parameter(name: "without_paginate", in: "query", required: false, schema: new OA\Schema(type: "integer", default: 0)),
            new OA\Parameter(name: "per_page", in: "query", required: false, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список Topics",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/TopicIndexResource")
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Get(
        path: "/api/guest/topics/",
        summary: "Список Обсуждения для не авторизованных пользователей",
        security: [['cookieAuth' => []]],
        tags: ["Topics"],
        parameters: [
            new OA\Parameter(name: "without_paginate", in: "query", required: false, schema: new OA\Schema(type: "integer", default: 0)),
            new OA\Parameter(name: "per_page", in: "query", required: false, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список Topics",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/TopicIndexResource")
                )
            )
        ]
    )]
    public function indexForEveryone(){}

    #[OA\Get(
        path: "/api/topics/",
        summary: "Список Обсуждения для авторизованных пользователей",
        security: [['cookieAuth' => []]],
        tags: ["Topics"],
        parameters: [
            new OA\Parameter(name: "without_paginate", in: "query", required: false, schema: new OA\Schema(type: "integer", default: 0)),
            new OA\Parameter(name: "per_page", in: "query", required: false, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список Topics",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/TopicIndexResource")
                )
            )
        ]
    )]
    public function indexForAuthenticatedUser(){}

    #[OA\Get(
        path: "/api/topics/{topic}/show",
        summary: "Получить Topic",
        security: [['cookieAuth' => []]],
        tags: ["Topics"],
        parameters: [
            new OA\Parameter(
                name: "topic",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Информация о NPC",
                content: new OA\JsonContent(ref: "#/components/schemas/TopicResource")
            ),
            new OA\Response(response: 404, description: "Topic не найден")
        ]
    )]
    public function show(){}

    #[OA\Post(
        path: "/api/admin/topics/create",
        summary: "Создать новый Topic",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/CreateTopicRequest")
        ),
        tags: ["Topics"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Topic успешно создан",
                content: new OA\JsonContent(ref: "#/components/schemas/TopicResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}

    #[OA\Put(
        path: "/api/admin/topics/{topic}/update",
        summary: "Обновить Topic",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateTopicRequest")
        ),
        tags: ["Topics"],
        parameters: [
            new OA\Parameter(name: "topic", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Topic успешно обновлён",
                content: new OA\JsonContent(ref: "#/components/schemas/TopicResource")
            ),
            new OA\Response(response: 404, description: "Topic не найден"),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function update(){}

    #[OA\Delete(
        path: "/api/admin/topics/{topics}/delete",
        summary: "Удалить Topic",
        security: [['cookieAuth' => []]],
        tags: ["Topics"],
        parameters: [
            new OA\Parameter(name: "topic", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Topic удалён",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Topic deleted successfully")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: 404, description: "Topic не найден")
        ]
    )]
    public function delete(){}
}
