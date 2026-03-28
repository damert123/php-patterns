<?php

namespace App\Patterns\EventChannel;

interface PublisherInterface
{
    public function publish($data);
}
