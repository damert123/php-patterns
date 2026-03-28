<?php

namespace App\Patterns\EventChannel;

class EventChannel implements EventChannelInterface
{
    private $topics = [];

    public function subscribe($topic, SubscriberInterface $subscriber)
    {
        $this->topics[$topic][] = $subscriber;

        $msg = "{$subscriber->getName()} подписан(-а) на канал {$topic}";

        return $msg;
    }

    public function publish($topic, $data)
    {
        if (empty($this->topics[$topic])) {
            return;
        }

        foreach ($this->topics[$topic] as $subscriber) {
            $subscriber->notify($data);
        }
    }
}
