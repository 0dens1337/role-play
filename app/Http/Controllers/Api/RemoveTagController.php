<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RemoveTagForNpcRequest;
use App\Models\Npc;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class RemoveTagController extends Controller
{
    public function forNpc(Npc $npc, RemoveTagForNpcRequest $request)
    {
        Gate::authorize('tag', $npc);

        $validated = $request->validated();

        if (! $npc->tags()->where('tag_id', $validated['tag_id'])->exists()) {
            return response()->json([
                'message' => 'This npc does not have this tag'
            ]);
        }

        $npc->tags()->detach($validated['tag_id']);

        return response()->json([
            'message' => 'Tag removed successfully'
        ]);
    }
}
