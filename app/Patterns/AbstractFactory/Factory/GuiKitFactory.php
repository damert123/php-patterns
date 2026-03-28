<?php

namespace App\Patterns\AbstractFactory\Factory;

use App\Patterns\AbstractFactory\Interfaces\GuiFactoryInterface;

class GuiKitFactory
{
    public function getFactory($type): GuiFactoryInterface
    {
        switch ($type) {
            case 'bootstrap':
                $factory = new BootstrapFactory;
                break;
            case 'semanticui':
                $factory = new SemanticUiFactory;
                break;
            default:
                throw new \Exception("Неизвестный тип фабрики {$type}");
        }

        return $factory;

    }
}
