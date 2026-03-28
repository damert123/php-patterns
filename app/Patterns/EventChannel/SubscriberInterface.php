<?php

namespace App\Patterns\EventChannel;

interface SubscriberInterface
{
    public function notify($data);

    public function getName();
}
