<?php

namespace App\Patterns\SimpleFactory;

interface MessengerSimpleFactoryInterface
{
    public function build(string $type);
}
