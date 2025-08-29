<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class LocationController extends Controller
{
    #[OA\Get(
        path: "/api/locations/",
        summary: "Список Локаций + Фильтрация",
        security: [['cookieAuth' => []]],
        tags: ["Locations"],
        parameters: [
            new OA\Parameter(name: "without_paginate", in: "query", required: false, schema: new OA\Schema(type: "integer", default: 0)),
            new OA\Parameter(name: "per_page", in: "query", required: false, schema: new OA\Schema(type: "integer")),
            new OA\Parameter(name: "name", in: "query", required: false, schema: new OA\Schema(type: "string")),
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
        path: "/api/locations/{location}/show",
        summary: "Просмотреть конкретную локацию",
        security: [['cookieAuth' => []]],
        tags: ["Locations"],
        parameters: [
            new OA\Parameter(
                name: "location",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Информация о Локации",
                content: new OA\JsonContent(ref: "#/components/schemas/LocationResource")
            ),
            new OA\Response(response: 404, description: "Локация не найдена")
        ]
    )]
    public function show(){}

    #[OA\Post(
        path: "/api/locations/create",
        summary: "Создать локацию",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/CreateMissionRequest")
        ),
        tags: ["Locations"],
        responses: [
            new OA\Response(
                response: 201,
                description: "локация успешно создана",
                content: new OA\JsonContent(ref: "#/components/schemas/LocationResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}

    #[OA\Patch(
        path: "/api/locations/{location}/update",
        summary: "Обновить location",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateNpcRequest")
        ),
        tags: ["Locations"],
        parameters: [
            new OA\Parameter(name: "location", in: "path", required: true, schema: new OA\Schema(type: "integer"))
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
        path: "/api/locations/{location}/delete",
        summary: "Удалить NPC",
        security: [['cookieAuth' => []]],
        tags: ["Locations"],
        parameters: [
            new OA\Parameter(name: "location", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "location удалён",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Location deleted successfully")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: 404, description: "location не найден")
        ]
    )]
    public function delete(){}
}
