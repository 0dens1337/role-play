<?php

namespace App\Telegram\Buttons;

use App\Enums\Telegram\GreetingsEnum;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class StartButton
{
    public static function startKeyboard(): Keyboard
    {
        return Keyboard::make()
            ->row([
                Button::make(GreetingsEnum::LORE->value)->action('mainAnswer')->param('topic', 'LORE'),
                Button::make(GreetingsEnum::NPC->value)->action('mainAnswer')->param('topic', 'NPC'),
            ])
            ->row([
                Button::make(GreetingsEnum::LEVELING->value)->action('mainAnswer')->param('topic', 'LEVELING'),
                Button::make(GreetingsEnum::ORGANIZATIONS->value)->action('mainAnswer')->param('topic', 'ORGANIZATIONS'),
            ])
            ->row([
                Button::make(GreetingsEnum::INVITE->value)->action('earlyAccess'),
            ]);
    }
}
