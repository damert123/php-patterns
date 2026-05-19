<?php

namespace App\Patterns\SimpleFactory;

use App\Patterns\Delegation\EmailMessenger;
use App\Patterns\Delegation\SmsMessenger;
use App\Patterns\StaticFactory\MessengerStaticFactoryInterface;

class MessengerSimpleFactory implements MessengerSimpleFactoryInterface
{

    public function build(string $type)
    {
        switch ($type) {
            case 'email':
                $messenger = new EmailMessenger();
                $messenger
                    ->setSender('admin@mail.ru')
                    ->setMessage('ПРИВЕТ!');
                break;
            case 'sms':
                $messenger =  new SmsMessenger();
                $messenger
                    ->setSender('89178236414')
                    ->setMessage('КУКУ');
                break;
            default:
                throw new \Exception("Неизвестный тип {$type}");
        }
    }
}
