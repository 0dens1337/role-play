<?php

namespace App\Telegram;

use App\Enums\Telegram\GreetingsEnum;
use App\Enums\Telegram\InviteCodeEnum;
use App\Telegram\Buttons\EarlyAccessButton;
use App\Telegram\Buttons\StartButton;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;

class Handler extends WebhookHandler
{
    public function getChatId(): string
    {
        return $this->message->chat()->id();
    }

    public function getCallbackChatId(): string
    {
        return $this->callbackQuery->message()->chat()->id();
    }

    public function getMessageId(): string
    {
        return $this->message->id();
    }

    public function getCallbackQueryMessageId(): string
    {
        return $this->callbackQuery->message()->id();
    }

    public function start(): void
    {
        Telegraph::chat($this->getChatId())
            ->message(GreetingsEnum::START_MESSAGE->value)
            ->keyboard(StartButton::startKeyboard())
            ->send();
    }

    public function earlyAccess(): void
    {
        Telegraph::chat($this->getCallbackChatId())
            ->edit($this->getCallbackQueryMessageId())
            ->message(InviteCodeEnum::GET_INVITE_MESSAGE->value)
            ->keyboard(EarlyAccessButton::earlyAccessButton())
            ->send();
    }

    public function mainMenu(): void
    {
        Telegraph::chat($this->getCallbackChatId())
            ->edit($this->getCallbackQueryMessageId())
            ->message(GreetingsEnum::MAIN_MENU_MESSAGE->value)
            ->keyboard(StartButton::startKeyboard())
            ->send();
    }

    public function mainAnswer(): void
    {
        $topic = $this->data->get('topic');

        $enum = GreetingsEnum::fromTopic($topic);
        $message = $enum?->response();

        Telegraph::chat($this->getCallbackChatId())
            ->edit($this->getCallbackQueryMessageId())
            ->message($message)
            ->keyboard(Keyboard::make()
                ->row([
                    Button::make('Назад')->action('mainMenu'),
                ]))
            ->send();
    }
}
