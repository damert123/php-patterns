<?php

namespace App\Patterns\EventChannel;

class Subscriber implements SubscriberInterface
{
    private $name;

    private array $notifications = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function notify($data): string
    {
        $msg = "{$this->getName()} оповещен(а) данными {$data}";

        $this->notifications[] = $data;

        return $msg;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /** @return array<int, mixed> */
    public function getNotifications(): array
    {
        return $this->notifications;
    }
}
