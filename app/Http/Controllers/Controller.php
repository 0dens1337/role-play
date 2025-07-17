<?php

namespace App\Http\Controllers;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    description: "Документация API для role-play",
    title: "Role-play API"
)]
#[OA\SecurityScheme(
    securityScheme: 'cookieAuth',
    type: 'apiKey',
    description: 'Authentication using JWT token stored in cookie',
    name: 'auth_token',
    in: 'cookie'
)]
abstract class Controller
{

}
