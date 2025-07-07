<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCharacterMetaRequest;
use App\Http\Resources\CharacterMetaResource;
use App\Models\Character;
use App\Models\CharacterMeta;
use Illuminate\Http\Request;

class CharacterMetaController extends Controller
{
    public function create(StoreCharacterMetaRequest $request)
    {
        $characterMeta = CharacterMeta::query()->create($request->validated());

        return CharacterMetaResource::make($characterMeta);
    }
}
