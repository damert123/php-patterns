<?php

namespace App\Patterns\Delegation;

class EmailMessenger extends Messenger
{
    public function send(): string|bool
    {
        return 'Привет! я Email Messenger';
    }
}
