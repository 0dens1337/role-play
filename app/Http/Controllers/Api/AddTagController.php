<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AddTagForNpcRequest;
use App\Models\Npc;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class AddTagController extends Controller
{
    public function forNpc(AddTagForNpcRequest $request, Npc $npc): JsonResponse
    {
        Gate::authorize('tag', $npc);

        $validated = $request->validated();

        if ($npc->tags()->where('tag_id', $validated['tag_id'])->exists()) {
            return response()->json([
                'message' => 'This npc is already in this tag'
            ]);
        }

        $npc->tags()->syncWithoutDetaching([$validated['tag_id'] => ['created_at' => now()]]);

        return response()->json([
            'message' => 'Tag added successfully'
        ]);
    }
}
