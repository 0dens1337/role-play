<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateSectionRequest;
use App\Http\Requests\Api\UpdateSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SectionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return SectionResource::collection(Section::all());
    }

    public function create(CreateSectionRequest $request): AnonymousResourceCollection
    {
        $section = Section::query()->create($request->validated());

        return SectionResource::make($section);
    }

    public function update(UpdateSectionRequest $request, Section $section): AnonymousResourceCollection
    {
        $section->update($request->validated());

        return SectionResource::make($section);
    }

    public function delete(Section $section): JsonResponse
    {
        $section->delete();

        return response()->json([
            'message' => 'Section deleted successfully'
        ]);
    }
}
