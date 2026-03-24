<?php

namespace App\Patterns\Delegation;

class SmsMessenger extends Messenger
{
    public function send(): string|bool
    {
        return 'Привет! я SMS Messenger';
    }
}
