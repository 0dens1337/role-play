<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiffResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'column' => $this->resource->column,
            'old_value' => $this->resource->old_value,
            'new_value' => $this->resource->new_value,
            'status' => $this->resource->status,
            'status_name' => $this->resource->status_name,
            'created_at' => $this->resource->created_at,
            'character' => CharactersResource::make($this->whenLoaded('character')),
        ];
    }
}
