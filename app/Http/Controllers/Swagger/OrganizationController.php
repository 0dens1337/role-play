<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class OrganizationController extends Controller
{
    #[OA\Get(
        path: "/api/organizations/",
        summary: "Список Орг| для админки будет '/api/admin/organizations/'",
        security: [['cookieAuth' => []]],
        tags: ["Organizations"],
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
                    items: new OA\Items(ref: "#/components/schemas/OrganizationIndexResource")
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Get(
        path: "/api/organizations/{organization}/show",
        summary: "Получить Оргу",
        security: [['cookieAuth' => []]],
        tags: ["Organizations"],
        parameters: [
            new OA\Parameter(
                name: "organization",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Информация об Орге",
                content: new OA\JsonContent(ref: "#/components/schemas/ShowOrganizationResource")
            ),
            new OA\Response(response: 404, description: "NPC не найден")
        ]
    )]
    public function show(){}

    #[OA\Post(
        path: "/api/admin/add-members",
        summary: "Создать ручное добавление персонажа к орге",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/AddMemberRequest")
        ),
        tags: ["Organizations"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Перс добавлен в оргу",
                content: new OA\JsonContent(ref: "#/components/schemas/NpcResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function addMembers(){}

    #[OA\Post(
        path: "/api/admin/create",
        summary: "Создать оргу",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/CreateOrganizationRequest")
        ),
        tags: ["Organizations"],
        responses: [
            new OA\Response(
                response: 201,
                description: "Перс добавлен в оргу",
                content: new OA\JsonContent(ref: "#/components/schemas/ShowOrganizationResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function create(){}

    #[OA\Patch(
        path: "/api/admin/{organization}/update",
        summary: "Обновить оргу",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/UpdateOrganizationRequest")
        ),
        tags: ["Organizations"],
        parameters: [
            new OA\Parameter(
                name: "organization",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "Перс добавлен в оргу",
                content: new OA\JsonContent(ref: "#/components/schemas/ShowOrganizationResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function update(){}

    #[OA\Patch(
        path: "/api/admin/{organization}/delete",
        summary: "Обновить оргу",
        security: [['cookieAuth' => []]],
        tags: ["Organizations"],
        parameters: [
            new OA\Parameter(
                name: "organization",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "Перс добавлен в оргу",
                content: new OA\JsonContent(ref: "#/components/schemas/ShowOrganizationResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function delete(){}
}
