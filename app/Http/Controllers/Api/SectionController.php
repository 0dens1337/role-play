<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateSectionRequest;
use App\Http\Requests\Api\UpdateSectionRequest;
use App\Http\Resources\SectionIndexResource;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SectionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return SectionIndexResource::collection(Section::all());
    }

    public function show(Section $section): SectionResource
    {
        return SectionResource::make($section->load('topics'));
    }

    public function create(CreateSectionRequest $request): SectionResource
    {
        $section = Section::query()->create($request->validated());

        return SectionIndexResource::make($section);
    }

    public function update(UpdateSectionRequest $request, Section $section): SectionResource
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
