<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

class DiffController extends Controller
{
    #[OA\Get(
        path: '/api/admin/diffs/',
        summary: 'Get list of characters with diffs',
        security: [['BearerAuth' => []]],
        tags: ['Diffs'],
        parameters: [
            new OA\QueryParameter(name: 'without_paginate', description: 'Without pagination', required: false, schema: new OA\Schema(type: 'boolean')),
            new OA\QueryParameter(name: 'per_page', description: 'Items per page', required: false, schema: new OA\Schema(type: 'integer', minimum: 1, maximum: 50)),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of characters',
                content: new OA\JsonContent(ref: '#/components/schemas/DiffIndexResource')
            ),
        ]
    )]
    public function index(){}

    #[OA\Get(
        path: '/api/admin/diffs/{character}/show',
        summary: 'Get diffs for a character',
        security: [['BearerAuth' => []]],
        tags: ['Diffs'],
        parameters: [
            new OA\PathParameter(name: 'character', description: 'Character ID', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Character and diffs', content: new OA\JsonContent()),
        ]
    )]
    public function show(){}

    #[OA\Post(
        path: '/api/admin/diffs/{character}/accept-all',
        summary: 'Accept all diffs for a character',
        security: [['BearerAuth' => []]],
        tags: ['Diffs'],
        parameters: [
            new OA\PathParameter(name: 'character', description: 'Character ID', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'All diffs applied', content: new OA\JsonContent()),
        ]
    )]
    public function acceptAll(){}

    #[OA\Post(
        path: '/api/admin/diffs/{character}/accept-selectively',
        summary: 'Accept selected diffs for a character',
        security: [['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['ids'],
                properties: [
                    new OA\Property(property: 'ids', type: 'array', items: new OA\Items(type: 'integer')),
                ]
            )
        ),
        tags: ['Diffs'],
        parameters: [
            new OA\PathParameter(name: 'character', description: 'Character ID', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Selected diffs applied', content: new OA\JsonContent()),
        ]
    )]
    public function acceptSelectively(){}

    #[OA\Post(
        path: '/api/admin/diffs/{character}/reject-all',
        summary: 'Reject all diffs for a character',
        security: [['BearerAuth' => []]],
        tags: ['Diffs'],
        parameters: [
            new OA\PathParameter(name: 'character', description: 'Character ID', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'All diffs rejected', content: new OA\JsonContent()),
        ]
    )]
    public function rejectAll(){}

    #[OA\Post(
        path: '/api/admin/diffs/{character}/reject-selectively',
        summary: 'Reject selected diffs for a character',
        security: [['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['ids'],
                properties: [
                    new OA\Property(property: 'ids', type: 'array', items: new OA\Items(type: 'integer')),
                ]
            )
        ),
        tags: ['Diffs'],
        parameters: [
            new OA\PathParameter(name: 'character', description: 'Character ID', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Selected diffs rejected', content: new OA\JsonContent()),
        ]
    )]
    public function rejectSelectively(){}
}
