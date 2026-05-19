<?php

namespace App\Patterns\AbstractMethod;

use App\Patterns\AbstractFactory\Factory\SemanticUiFactory;
use App\Patterns\AbstractFactory\Interfaces\GuiFactoryInterface;

class SemanticDialogForm extends AbstractForm
{
    protected function createGuiKit(): GuiFactoryInterface
    {
        return new SemanticUiFactory;
    }
}
