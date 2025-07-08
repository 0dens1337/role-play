<?php

namespace App\Services;

use App\Enums\CharacterReviewEnum;
use App\Models\Diff;

class DataReviewService
{
    public static function addDataToReview($character, array $validated)
    {
        $diffs = collect($validated)
            ->filter(fn ($value, $column) => $value != $character->$column)
            ->map(function ($value, $column) use ($character) {
                return [
                    'character_id' => $character->id,
                    'column' => $column,
                    'old_value' => $character->value,
                    'new_value' => $value,
                    'status' => CharacterReviewEnum::ON_REVIEW->value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });

        foreach ($diffs as $diff) {
            $exists = Diff::forReview($diff)->exists();

            if (!$exists) {
                Diff::query()->insert($diff);
            }
        }
    }

    public static function updateDataForJustCreated($character, array $validated): void
    {
        $onReviewDiffs = Diff::query()
            ->where('character_id', $character->id)
            ->get()
            ->keyBy('column');

        foreach ($validated as $column => $newValue) {
            if (isset($onReviewDiffs[$column]) && $character->just_created) {
                $diff = $onReviewDiffs[$column];
                $diff->new_value = $newValue;
                $diff->updated_at = now();

                $diff->save();
            }
        }
    }

    public static function updateDataToReview($character, array $validated)
    {
        $diffs = collect($validated)
            ->filter(fn ($value, $column) => $value != $character->$column)
            ->map(function ($value, $column) use ($character) {
                return [
                    'character_id' => $character->id,
                    'column' => $column,
                    'old_value' => $character->$column,
                    'new_value' => $value,
                    'status' => CharacterReviewEnum::ON_REVIEW->value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            });

        foreach ($diffs as $diff) {
            $exists = Diff::query()
                ->forReview($diff)->exists();

            if (!$exists) {
                Diff::query()->insert($diff);
            } else {
                Diff::query()
                    ->where('character_id', $diff['character_id'])
                    ->where('column', $diff['column'])
                    ->where('status', CharacterReviewEnum::ON_REVIEW->value)
                    ->update([
                        'new_value' => $diff['new_value'],
                        'updated_at' => now(),
                    ]);
            }
        }
    }
}
