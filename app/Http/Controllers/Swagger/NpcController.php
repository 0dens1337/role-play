<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class NpcController extends Controller
{
    #[OA\Get(
        path: "/api/npcs/",
        summary: "Список NPC",
        security: [['cookieAuth' => []]],
        tags: ["NPCs"],
        parameters: [
            new OA\Parameter(name: "without_paginate", in: "query", required: false, schema: new OA\Schema(type: "integer", default: 0)),
            new OA\Parameter(name: "per_page", in: "query", required: false, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список NPC",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/NpcResource")
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Get(
        path: "/api/npcs/{npc}/show",
        summary: "Получить одного NPC",
        security: [['cookieAuth' => []]],
        tags: ["NPCs"],
        parameters: [
            new OA\Parameter(
                name: "npc",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Информация о NPC",
                content: new OA\JsonContent(ref: "#/components/schemas/NpcShowResource")
            ),
            new OA\Response(response: 404, description: "NPC не найден")
        ]
    )]
    public function show(){}

    #[OA\Post(
        path: "/api/npcs/create",
        summary: "Создать нового NPC",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/CreateNpcRequest")
        ),
        tags: ["NPCs"],
        responses: [
            new OA\Response(
                response: 201,
                description: "NPC успешно создан",
                content: new OA\JsonContent(ref: "#/components/schemas/NpcResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}

    #[OA\Put(
        path: "/api/npcs/{npc}/update",
        summary: "Обновить NPC",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateNpcRequest")
        ),
        tags: ["NPCs"],
        parameters: [
            new OA\Parameter(name: "npc", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "NPC успешно обновлён",
                content: new OA\JsonContent(ref: "#/components/schemas/NpcShowResource")
            ),
            new OA\Response(response: 404, description: "NPC не найден"),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function update(){}

    #[OA\Delete(
        path: "/api/npcs/{npc}/delete",
        summary: "Удалить NPC",
        security: [['cookieAuth' => []]],
        tags: ["NPCs"],
        parameters: [
            new OA\Parameter(name: "npc", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "NPC удалён",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Npc deleted successfully")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: 404, description: "NPC не найден")
        ]
    )]
    public function delete(){}
}
