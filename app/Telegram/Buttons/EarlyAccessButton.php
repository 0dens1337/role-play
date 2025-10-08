<?php

namespace App\Telegram\Buttons;

use App\Enums\Telegram\InviteCodeEnum;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class EarlyAccessButton
{
    public static function earlyAccessButton(): Keyboard
    {
        return Keyboard::make()
            ->row([
                Button::make(InviteCodeEnum::INVITE_BUTTON_MESSAGE->value)->url(InviteCodeEnum::VELDRECHT_GET_INVITE_LINK->value)
            ])
            ->row([
                Button::make(InviteCodeEnum::BACK->value)->action('mainMenu'),
            ]);
    }
}
