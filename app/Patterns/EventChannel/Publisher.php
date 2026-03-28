<?php

namespace App\Patterns\EventChannel;

class Publisher implements PublisherInterface
{
    private $topic;

    private $eventChannel;

    public function __construct(string $topic, EventChannelInterface $eventChannel)
    {
        $this->topic = $topic;

        $this->eventChannel = $eventChannel;
    }

    public function publish($data): void
    {
        $this->eventChannel->publish($this->topic, $data);
    }
}
