<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class AddTagController extends Controller
{
    #[OA\Post(
        path: "/api/add-tags/{npc}/npc",
        description: "Добавляет указанный тег к переданному NPC. Возвращает сообщение об успехе или ошибке, если тег уже назначен.",
        summary: "Добавить тег NPC",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/AddTagForNpcRequest")
        ),
        tags: ["Add Tags"],
        parameters: [
            new OA\Parameter(
                name: "npc",
                description: "ID NPC",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer", example: 5)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Тег успешно добавлен",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Tag added successfully")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(
                response: 409,
                description: "Тег уже назначен NPC",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "This npc is already in this tag")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function forNpc(){}
}
