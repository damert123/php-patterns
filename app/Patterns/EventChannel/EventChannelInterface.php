<?php

namespace App\Patterns\EventChannel;

interface EventChannelInterface
{
    public function publish($topic, $data);

    public function subscribe($topic, SubscriberInterface $subscriber);
}
