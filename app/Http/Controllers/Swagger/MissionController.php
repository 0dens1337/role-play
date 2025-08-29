<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class MissionController extends Controller
{
    #[OA\Get(
        path: "/api/missions/",
        summary: "Список Локаций + Фильтрация",
        security: [['cookieAuth' => []]],
        tags: ["Missions"],
        parameters: [
            new OA\Parameter(name: "without_paginate", in: "query", required: false, schema: new OA\Schema(type: "integer", default: 0)),
            new OA\Parameter(name: "per_page", in: "query", required: false, schema: new OA\Schema(type: "integer")),
            new OA\Parameter(name: "title", in: "query", required: false, schema: new OA\Schema(type: "string")),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список Missions",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/MissionResource")
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Get(
        path: "/api/missions/{mission}/show",
        summary: "Просмотреть конкретную mission",
        security: [['cookieAuth' => []]],
        tags: ["Missions"],
        parameters: [
            new OA\Parameter(
                name: "mission",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Информация о mission",
                content: new OA\JsonContent(ref: "#/components/schemas/MissionShowResource")
            ),
            new OA\Response(response: 404, description: "Mission не найдена")
        ]
    )]
    public function show(){}

    #[OA\Post(
        path: "/api/missions/create",
        summary: "Создать mission",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/CreateMissionRequest")
        ),
        tags: ["Missions"],
        responses: [
            new OA\Response(
                response: 201,
                description: "mission успешно создана",
                content: new OA\JsonContent(ref: "#/components/schemas/MissionShowResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}

    #[OA\Patch(
        path: "/api/missions/{mission}/update",
        summary: "Обновить missions",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateMissionRequest")
        ),
        tags: ["Missions"],
        parameters: [
            new OA\Parameter(name: "mission", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "mission успешно обновлён",
                content: new OA\JsonContent(ref: "#/components/schemas/MissionShowResource")
            ),
            new OA\Response(response: 404, description: "Mission не найден"),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function update(){}

    #[OA\Delete(
        path: "/api/missions/{mission}/delete",
        summary: "Удалить mission",
        security: [['cookieAuth' => []]],
        tags: ["Missions"],
        parameters: [
            new OA\Parameter(name: "mission", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "mission удалён",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "mission deleted successfully")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: 404, description: "missions не найден")
        ]
    )]
    public function delete(){}

    #[OA\Post(
        path: "/api/missions/{mission}/take",
        summary: "Взять миссию персонажем",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/TakeMissionRequest")
        ),
        tags: ["Missions"],
        parameters: [
            new OA\Parameter(name: "mission", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Миссия успешно взята",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Миссия успешно взята")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(
                response: 409,
                description: "Персонаж уже взял эту миссию"
            )
        ]
    )]
    public function takeMission(){}

    #[OA\Post(
        path: "/api/missions/{mission}/send-to-review",
        summary: "Отправить выполнение миссии на проверку",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/SendMissionToReviewRequest")
        ),
        tags: ["Missions"],
        parameters: [
            new OA\Parameter(name: "mission", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Пруфы отправлены",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Пруфы по выполнению миссии отправлены на проверку главе")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(
                response: 404,
                description: "Нет активной миссии у данного персонажа"
            ),
            new OA\Response(
                response: 413,
                description: "Время выполнения задания вышло"
            )
        ]
    )]
    public function sendMissionToReview(){}

    #[OA\Get(
        path: "/api/organizations/{organization}/missions-to-review",
        summary: "Получить миссии на проверку",
        security: [['cookieAuth' => []]],
        tags: ["Missions"],
        parameters: [
            new OA\Parameter(name: "organization", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Миссии, ожидающие проверки",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/MissionShowResource")
                )
            )
        ]
    )]
    public function indexMissionsToReview(){}

    #[OA\Post(
        path: "/api/missions/{mission}/accept-mission",
        summary: "Принять выполненную миссию",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/ReviewMissionRequest")
        ),
        tags: ["Missions"],
        parameters: [
            new OA\Parameter(name: "mission", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Миссия успешно принята",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Миссия была помечена как выполненная успешно, исполнитель получит награду автоматически.")
                    ],
                    type: "object"
                )
            )
        ]
    )]
    public function acceptMission(){}

    #[OA\Post(
        path: "/api/missions/{mission}/reject-mission",
        summary: "Отклонить выполненную миссию",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/ReviewMissionRequest")
        ),
        tags: ["Missions"],
        parameters: [
            new OA\Parameter(name: "mission", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Миссия была отклонена",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Миссия была отклонена, причина указывается лично исполнителю.")
                    ],
                    type: "object"
                )
            )
        ]
    )]
    public function rejectMission(){}
}
