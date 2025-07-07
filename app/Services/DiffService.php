<?php

namespace App\Services;

use App\Enums\CharacterReviewEnum;
use App\Models\Character;

class DiffService
{
    public static function acceptAllDiffs(Character $character)
    {
        $diffs = $character->diffs()
            ->where('status', CharacterReviewEnum::ON_REVIEW->value)
            ->get();

        foreach ($diffs as $diff) {
            $diff->status = CharacterReviewEnum::APPROVED->value;
            $diff->save();
        }
    }

    public static function acceptSelectivelyDiffs(Character $character, array $validated)
    {
        $ids = $validated['ids'] ?? [];
        $diffs = $character->diffs()
            ->where('status', CharacterReviewEnum::ON_REVIEW->value)
            ->whereIn('id', $ids)
            ->get();

        foreach ($diffs as $diff) {
            $diff->status = CharacterReviewEnum::APPROVED->value;
            $diff->save();
        }
    }

    public static function rejectAllDiffs(Character $character)
    {
        $diffs = $character->diffs()->where('status', CharacterReviewEnum::ON_REVIEW->value)->get();

        foreach ($diffs as $diff) {
            $diff->status = CharacterReviewEnum::REJECTED->value;
            $diff->save();
        }
    }

    public static function rejectSelectivelyDiffs(Character $character, array $validated)
    {
        $ids = $validated['ids'] ?? [];
        $diffs = $character->diffs()
            ->where('status', CharacterReviewEnum::ON_REVIEW->value)
            ->whereIn('id', $ids)
            ->get();

        foreach ($diffs as $diff) {
            $diff->status = CharacterReviewEnum::REJECTED->value;
            $diff->save();
        }
    }
}
