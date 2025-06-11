<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    description: "Документация API для role-play",
    title: "Role-play API"
)]
#[OA\SecurityScheme(
    securityScheme: 'BearerAuth',
    type: 'http',
    description: 'Bearer authentication using JWT token',
    bearerFormat: 'JWT',
    scheme: 'bearer'
)]
abstract class Controller
{

}
