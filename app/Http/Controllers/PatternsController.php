<?php

namespace App\Http\Controllers;

use App\Patterns\Delegation\AppMessenger;
use App\Patterns\PropertyContainer\BlogPost;

class PatternsController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        return view('patterns.index', [
            'patterns' => [
                ['name' => 'Контейнер свойств', 'url' => route('patterns.property-container')],
                ['name' => 'Делегирование', 'url' => route('patterns.delegation')],
            ],
        ]);
    }

    public function delegation(): \Illuminate\View\View
    {
        $name = 'Делегирование (Delegation)';

        $item = new AppMessenger();

        $emailResult = $item
            ->setSender('sender@mail.ru')
            ->setRecipient('recipient@mail.ru')
            ->setMessage('Hello email messenger')
            ->send();

        $smsResult = $item->toSms()
            ->setSender('89178239146')
            ->setRecipient('84324023423')
            ->setMessage('Hello SMS messenger')
            ->send();

        return view('patterns.delegation', [
            'name' => $name,
            'item' => $item,
            'emailResult' => $emailResult,
            'smsResult' => $smsResult,
        ]);
    }

    public function propertyContainer(): \Illuminate\View\View
    {
        $name = 'Контейнер свойств';

        $item = new BlogPost();
        $item->setTitle('Загловок статьи');
        $item->setCategoryId(10);

        $item->addProperty('view_count', 100);
        $item->addProperty('last_update', '2030-02-01');
        $item->updateProperty('last_update', '2025-02-01');
        $item->addProperty('read_only', true);
        $item->deleteProperty('read_only');

        return view('patterns.property-container', [
            'name' => $name,
            'item' => $item,
        ]);
    }
}
