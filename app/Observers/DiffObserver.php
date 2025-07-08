<?php

namespace App\Observers;

use App\Enums\CharacterReviewEnum;

class DiffObserver
{
    public function updated($diff)
    {
        if ($diff->isDirty('status') && $diff->status == CharacterReviewEnum::APPROVED->value) {
            $character = $diff->character;
            $character->{$diff->column} = $diff->new_value;
            $character->just_created = false;

            $character->save();
        }
    }
}
