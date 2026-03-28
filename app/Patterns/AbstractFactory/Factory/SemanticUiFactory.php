<?php

namespace App\Patterns\AbstractFactory\Factory;

use App\Patterns\AbstractFactory\ButtonSemanticUi;
use App\Patterns\AbstractFactory\CheckBoxSemanticUi;
use App\Patterns\AbstractFactory\Interfaces\ButtonInterface;
use App\Patterns\AbstractFactory\Interfaces\CheckBoxInterface;
use App\Patterns\AbstractFactory\Interfaces\GuiFactoryInterface;

class SemanticUiFactory implements GuiFactoryInterface
{
    public function buildButtons(): ButtonInterface
    {
        return new ButtonSemanticUi;
    }

    public function buildCheckBox(): CheckBoxInterface
    {
        return new CheckBoxSemanticUi;
    }
}
