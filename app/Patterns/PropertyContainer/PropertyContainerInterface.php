<?php

namespace App\Patterns\PropertyContainer;

interface PropertyContainerInterface
{
    public function addProperty($propertyName, $value): void;

    public function deleteProperty($propertyName): void;

    public function getProperty($propertyName): mixed;

    public function updateProperty($propertyName, $value): void;
}
