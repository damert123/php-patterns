<?php

namespace App\Patterns\StaticFactory;

use App\Patterns\Delegation\AppMessenger;
use App\Patterns\Delegation\MessengerInterface;

class StaticFactory implements MessengerStaticFactoryInterface
{
    public static function build(string $type = 'email'): MessengerInterface
    {
        $messenger = new AppMessenger();

        switch ($type) {
            case 'email':
                $messenger->toEmail();
                $sender = 'admin@site.ru';
                break;
            case 'sms':
                $messenger->toSms();
                $sender = '89178239146';
                break;
            default:
                throw new \Exception("Неизвестный тип {$type}");
        }

        $messenger
            ->setSender($sender)
            ->setMessage('default message');

        return $messenger;
    }
}
