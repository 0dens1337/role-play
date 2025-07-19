<?php

namespace App\Enums;

enum TopicTypeEnum: int
{
    case INFO = 1;
    case VELDRECHT = 2;
    case ISLAND = 3;
    case QUEST = 4;

    public function name(): string
    {
        return match ($this) {
            self::INFO => 'Info',
            self::VELDRECHT => 'Veldrecht',
            self::ISLAND => 'Island',
            self::QUEST => 'Question',
        };
    }
}
