<?php

namespace App\Patterns\PropertyContainer;

class PropertyContainer implements PropertyContainerInterface
{
    private array $propertyContainer = [];

    public function addProperty($propertyName, $value): void
    {
        $this->propertyContainer[$propertyName] = $value;
    }

    public function deleteProperty($propertyName): void
    {
        unset($this->propertyContainer[$propertyName]);
    }

    public function getProperty($propertyName): mixed
    {
        return $this->propertyContainer[$propertyName] ?? null;
    }

    public function getProperties(): array
    {
        return $this->propertyContainer;
    }

    public function updateProperty($propertyName, $value): void
    {
        if (! isset($this->propertyContainer[$propertyName])) {
            throw new \Exception("Property [{$propertyName}] not found");
        }

        $this->propertyContainer[$propertyName] = $value;
    }
}
