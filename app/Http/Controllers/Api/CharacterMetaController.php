<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCharacterMetaRequest;
use App\Http\Requests\Api\UpdateCharacterMetaRequest;
use App\Http\Resources\CharacterMetaResource;
use App\Models\Character;
use App\Services\AvatarService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
class CharacterMetaController extends Controller
{
    public function create(StoreCharacterMetaRequest $request, Character $character): JsonResponse|CharacterMetaResource
    {
        if (!$character->exists) {
            return response()->json(['message' => 'Character doesnt exist'], Response::HTTP_BAD_REQUEST);
        }

        if ($character->characterMeta()->exists()) {
            return response()->json(['message' => 'Character meta already exists'], Response::HTTP_CONFLICT);
        }

        $metaData = $request->validated();
        $metaData['character_id'] = $character->id;
        $file = $request->file('image');

        $paths = AvatarService::uploadCharacterAvatar($file, $character);
        $metaData['image'] = $paths['original_path'];

        return CharacterMetaResource::make($character->characterMeta()->create($metaData));
    }

    public function update(UpdateCharacterMetaRequest $request, Character $character): JsonResponse|CharacterMetaResource
    {
        if (!$character->exists) {
            return response()->json(['message' => 'Character doesnt exist'], Response::HTTP_BAD_REQUEST);
        }

        $characterMeta = $character->characterMeta;

        if (!$characterMeta) {
            return response()->json(['message' => 'Character meta doesnt exist'], Response::HTTP_BAD_REQUEST);
        }

        $metaData = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $paths = AvatarService::uploadCharacterAvatar($file, $character);
            $metaData['image'] = $paths['original_path'];
        }

        $characterMeta->update($metaData);

        return CharacterMetaResource::make($characterMeta);
    }
}
