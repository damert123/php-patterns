<?php

namespace App\Patterns\AbstractFactory\Factory;

use App\Patterns\AbstractFactory\ButtonBootstrap;
use App\Patterns\AbstractFactory\CheckBoxBootstrap;
use App\Patterns\AbstractFactory\Interfaces\ButtonInterface;
use App\Patterns\AbstractFactory\Interfaces\CheckBoxInterface;
use App\Patterns\AbstractFactory\Interfaces\GuiFactoryInterface;

class BootstrapFactory implements GuiFactoryInterface
{
    public function buildButtons(): ButtonInterface
    {
        return new ButtonBootstrap;
    }

    public function buildCheckBox(): CheckBoxInterface
    {
        return new CheckBoxBootstrap;
    }
}
