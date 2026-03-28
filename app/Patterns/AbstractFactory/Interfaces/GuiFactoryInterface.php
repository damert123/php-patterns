<?php

namespace App\Patterns\AbstractFactory\Interfaces;

interface GuiFactoryInterface
{
    public function buildButtons(): ButtonInterface;

    public function buildCheckBox(): CheckBoxInterface;
}
