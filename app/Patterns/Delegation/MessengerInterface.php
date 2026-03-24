<?php

namespace App\Patterns\Delegation;

interface MessengerInterface
{
    public function setSender($value): MessengerInterface;

    public function setRecipient($value): MessengerInterface;

    public function setMessage($value): MessengerInterface;

    public function send(): string|bool;
}
