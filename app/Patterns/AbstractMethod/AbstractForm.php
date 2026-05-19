<?php

namespace App\Patterns\AbstractMethod;

use App\Patterns\AbstractFactory\Interfaces\GuiFactoryInterface;

abstract class AbstractForm implements FormInterface
{
    public function render(): array
    {
        $guiKit = $this->createGuiKit();
        $result[] = $guiKit->buildCheckBox()->draw();
        $result[] = $guiKit->buildButtons()->draw();

        return $result;
    }

    abstract protected function createGuiKit(): GuiFactoryInterface;
}
