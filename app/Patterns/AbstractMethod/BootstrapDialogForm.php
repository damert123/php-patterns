<?php

namespace App\Patterns\AbstractMethod;

use App\Patterns\AbstractFactory\Factory\BootstrapFactory;
use App\Patterns\AbstractFactory\Interfaces\GuiFactoryInterface;

class BootstrapDialogForm extends AbstractForm
{
    protected function createGuiKit(): GuiFactoryInterface
    {
        return new BootstrapFactory;
    }
}
