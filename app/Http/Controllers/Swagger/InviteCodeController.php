<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class InviteCodeController extends Controller
{
    #[OA\Get(
        path: "/api/admin/invites",
        summary: "Список Invite Code",
        security: [['cookieAuth' => []]],
        tags: ["Invite Code"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Список Invite Code",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/InviteCodeResource")
                )
            )
        ]
    )]
    public function index(){}

    #[OA\Get(
        path: "/api/guests/invites",
        summary: "Кол-во символов у кода",
        security: [['cookieAuth' => []]],
        tags: ["Invite Code"],
        responses: [
            new OA\Response(
                response: 200,
                description: "Кол-во символов у кода",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/InviteCodeNumOfCharactersResource")
                )
            )
        ]
    )]
    public function indexNumOfCharacters(){}

    #[OA\Post(
        path: "/api/admin/invites/create",
        summary: "Создать новый код (код может существовать только 1)",
        security: [['cookieAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: "#/components/schemas/CreateInviteCodeRequest")
        ),
        tags: ["Invite Code"],
        responses: [
            new OA\Response(
                response: 201,
                description: "NPC успешно создан",
                content: new OA\JsonContent(ref: "#/components/schemas/InviteCodeResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function store(){}

    #[OA\Delete(
        path: "/api/admin/invites/{inviteCode}/delete",
        summary: "Удаление кода",
        security: [['cookieAuth' => []]],
        tags: ["Invite Code"],
        parameters: [
            new OA\Parameter(name: "inviteCode", in: "path", required: true, schema: new OA\Schema(type: "integer"))
        ],
        responses: [
            new OA\Response(
                response: 201,
                description: "NPC успешно создан",
                content: new OA\JsonContent(ref: "#/components/schemas/InviteCodeResource")
            ),
            new OA\Response(response: 422, description: "Ошибка валидации")
        ]
    )]
    public function delete(){}
}
