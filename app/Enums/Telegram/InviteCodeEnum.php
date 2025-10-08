<?php

namespace App\Enums\Telegram;

enum InviteCodeEnum: string
{
    case VELDRECHT_GET_INVITE_LINK = 'veldrecht.site/get-invite';

    case GET_INVITE_MESSAGE = "Подробно, с правилами получения invite кода можно ознакомиться на сайте, в разделе Получения Кода.\nВкратце вы должны согласиться с лицензионным соглашением, предоставить необходимые данные главе, а также быть совершеннолетним.";
    case INVITE_BUTTON_MESSAGE = 'Получение кода';
    case BACK = 'Назад';
}
