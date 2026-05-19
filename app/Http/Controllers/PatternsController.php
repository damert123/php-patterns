<?php

namespace App\Http\Controllers;

use App\Patterns\AbstractFactory\Factory\GuiKitFactory;
use App\Patterns\AbstractMethod\BootstrapDialogForm;
use App\Patterns\AbstractMethod\SemanticDialogForm;
use App\Patterns\Delegation\AppMessenger;
use App\Patterns\EventChannel\EventChannel;
use App\Patterns\EventChannel\Publisher;
use App\Patterns\EventChannel\Subscriber;
use App\Patterns\PropertyContainer\BlogPost;
use App\Patterns\SimpleFactory\MessengerSimpleFactory;
use App\Patterns\StaticFactory\StaticFactory;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\Facades\Redis;
use Illuminate\View\View;

class PatternsController extends Controller
{
    private $guikit;

    public function __construct()
    {
        $this->guikit = (new GuiKitFactory)->getFactory('bootstrap');
    }

    public function index(): View
    {
        return view('patterns.index', [
            'categories' => [
                [
                    'name' => 'Фундаментальные паттерны',
                    'description' => 'Базовые паттерны, лежащие в основе остальных',
                    'patterns' => [
                        ['name' => 'Контейнер свойств', 'url' => route('patterns.property-container')],
                        ['name' => 'Делегирование', 'url' => route('patterns.delegation')],
                        ['name' => 'Канал событий (Event Channel)', 'url' => route('patterns.event-channel')],
                        ['name' => 'Интерфейс (Interface)', 'url' => route('patterns.interface')],
                    ],
                ],
                [
                    'name' => 'Порождающие паттерны',
                    'description' => 'Отвечают за создание объектов',
                    'patterns' => [
                        ['name' => 'Абстрактная фабрика', 'url' => route('patterns.abstract-factory')],
                        ['name' => 'Фабричный метод', 'url' => route('patterns.abstract-method')],
                    ],
                ],
            ],
        ]);
    }


    public function simpleFactory()
    {
        $factory = new MessengerSimpleFactory();
        $appMailMessenger = $factory->build('email');
        $appSmsMessenger = $factory->build('sms');
    }
    public function staticFactory()
    {
        $appMailMessenger = StaticFactory::build('email');
        $appSmsMessenger = StaticFactory::build('sms');


    }

    public function abstractFactory(): View
    {


        $bootstrap = (new GuiKitFactory)->getFactory('bootstrap');
        $semanticUi = (new GuiKitFactory)->getFactory('semanticui');

        $bootstrapButton = $bootstrap->buildButtons();
        $bootstrapCheckBox = $bootstrap->buildCheckBox();

        $semanticButton = $semanticUi->buildButtons();
        $semanticCheckBox = $semanticUi->buildCheckBox();

        return view('patterns.abstract-factory', [
            'name' => 'Абстрактная фабрика (Abstract Factory)',
            'bootstrapButton' => $bootstrapButton,
            'bootstrapCheckBox' => $bootstrapCheckBox,
            'semanticButton' => $semanticButton,
            'semanticCheckBox' => $semanticCheckBox,
        ]);
    }

    public function interfacePattern(): View
    {
        return view('patterns.interface', [
            'name' => 'Интерфейс (Interface)',
        ]);
    }

    public function eventChannel(): View
    {
        $name = 'Канал событий (Event Channel)';

        $newsChannel = new EventChannel;

        $kWorkOffers = new Publisher('kWork-offers', $newsChannel);
        $freelanceOffers = new Publisher('freelance-offers', $newsChannel);
        $freelanceDaily = new Publisher('freelance-offers', $newsChannel);
        $vkOffers = new Publisher('vk-offers', $newsChannel);

        $valera = new Subscriber('Valera');
        $sasha = new Subscriber('Sasha');
        $vova = new Subscriber('Vova');
        $petya = new Subscriber('Petya');

        $subscriptions = [];
        $subscriptions[] = $newsChannel->subscribe('kWork-offers', $vova);
        $subscriptions[] = $newsChannel->subscribe('freelance-offers', $sasha);
        $subscriptions[] = $newsChannel->subscribe('freelance-offers', $petya);
        $subscriptions[] = $newsChannel->subscribe('vk-offers', $valera);
        $subscriptions[] = $newsChannel->subscribe('kWork-offers', $vova);

        $kWorkOffers->publish('New offer Kwork.ru');
        $freelanceOffers->publish('New offer FreeLance.ru');
        $freelanceDaily->publish('New offer FreeLance.ru DAILY');
        $vkOffers->publish('New offer VK.ru');

        $subscribers = [$valera, $sasha, $vova, $petya];

        $channels = [
            ['name' => 'kWork-offers', 'color' => 'blue'],
            ['name' => 'freelance-offers', 'color' => 'green'],
            ['name' => 'vk-offers', 'color' => 'purple'],
        ];

        return view('patterns.event-channel', [
            'name' => $name,
            'subscriptions' => $subscriptions,
            'subscribers' => $subscribers,
            'channels' => $channels,
        ]);
    }

    public function delegation(): View
    {
        $name = 'Делегирование (Delegation)';

        $item = new AppMessenger;

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

    public function propertyContainer(): View
    {
        $name = 'Контейнер свойств';

        $item = new BlogPost;
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

    public function abstractMethod(): View
    {
        $bootstrapForm = new BootstrapDialogForm;
        $semanticForm = new SemanticDialogForm;

        return view('patterns.abstract-method', [
            'name' => 'Фабричный метод (Factory Method)',
            'bootstrapResult' => $bootstrapForm->render(),
            'semanticResult' => $semanticForm->render(),
        ]);
    }

    /**
     * @return mixed
     */
    public function getGuikit()
    {
        return $this->guikit;
    }
}
