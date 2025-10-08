<?php

namespace App\Enums\Telegram;

use Illuminate\Support\Str;

enum GreetingsEnum: string
{
    case LORE = 'Узнать детали Veldrecht';
    case NPC = 'Узнать детали героев';
    case ORGANIZATIONS = 'Узнать об организациях';
    case LEVELING = 'Узнать о репутации';
    case INVITE = 'Узнать о раннем доступе в мир Veldrecht';
    case START_MESSAGE = 'Приветствую, путник. Хранитель будет рад ответить на твои вопросы и постарается помочь. Выбери что ты хочешь узнать: ';
    case MAIN_MENU_MESSAGE = 'Выбери какой вопрос ты хочешь задать хранителю: ';

    public function response(): string
    {
        return match ($this) {
            self::LORE => "Здесь будут детали мира Veldrecht...",
            self::NPC => "Здесь будут детали героев...",
            self::LEVELING => "Здесь будет информация о репутации...",
            self::ORGANIZATIONS => "Здесь будет информация об организациях...",
            default => "Неизвестное действие, повторите попытку",
        };
    }

    public static function fromTopic(string $topic): ?self
    {
        return collect(self::cases())
            ->first(fn($case) => $case->name === $topic);
    }
}
