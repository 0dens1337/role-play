<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class SectionController extends Controller
{
    #[OA\Get(
        path: "/api/admin/sections/",
        summary: "Список Разделов",
        security: [['cookieAuth' => []]],
        tags: ["Sections"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список NPC",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/SectionIndexResource")
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Post(
        path: "/api/admin/sections/create",
        summary: "Создать нового NPC",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/SectionResource")
        ),
        tags: ["Sections"],
        responses: [
            new OA\Response(
                response: 201,
                description: "NPC успешно создан",
                content: new OA\JsonContent(ref: "#/components/schemas/CreateSectionRequest")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}

    #[OA\Get(
        path: "/api/admin/sections/{section}/show",
        summary: "Получить один Раздел",
        security: [['cookieAuth' => []]],
        tags: ["Sections"],
        parameters: [
            new OA\Parameter(
                name: "section",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Информация о Section",
                content: new OA\JsonContent(ref: "#/components/schemas/SectionResource")
            ),
            new OA\Response(response: 404, description: "NPC не найден")
        ]
    )]
    public function show(){}

    #[OA\Put(
        path: "/api/admin/sections/{section}/update",
        summary: "Обновить Раздел",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateSectionRequest")
        ),
        tags: ["Sections"],
        parameters: [
            new OA\Parameter(name: "section", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Section успешно обновлён",
                content: new OA\JsonContent(ref: "#/components/schemas/SectionResource")
            ),
            new OA\Response(response: 404, description: "NPC не найден"),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function update(){}

    #[OA\Delete(
        path: "/api/admin/sections/{section}/delete",
        summary: "Удалить Раздел",
        security: [['cookieAuth' => []]],
        tags: ["Sections"],
        parameters: [
            new OA\Parameter(name: "section", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Section удалён",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: "message", type: "string", example: "Npc deleted successfully")
                    ],
                    type: "object"
                )
            ),
            new OA\Response(response: 404, description: "Раздел не найден")
        ]
    )]
    public function delete(){}
}
