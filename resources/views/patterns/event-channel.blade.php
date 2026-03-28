@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('patterns.index') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">&larr; Паттерны</a>
    </div>

    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $name }}</h1>
    <p class="text-gray-500 text-sm mb-8">
        Паттерн реализует механизм публикации/подписки через центральный канал событий.
        Издатели (Publisher) отправляют данные в канал по теме, а подписчики (Subscriber) получают уведомления только по тем темам, на которые подписаны.
    </p>

    {{-- Каналы и подписчики --}}
    <div class="grid grid-cols-3 gap-6 mb-8">

        @foreach($channels as $channel)
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                    <span class="w-2 h-2 rounded-full bg-{{ $channel['color'] }}-400"></span>
                    <h2 class="font-semibold text-gray-700">{{ $channel['name'] }}</h2>
                </div>
                <p class="text-xs text-gray-400 mb-3">Подписчики канала:</p>
                <div class="space-y-2">
                    @foreach($subscribers as $subscriber)
                        @if(in_array($channel['name'], ['kWork-offers']) && $subscriber->getName() === 'Vova'
                            || in_array($channel['name'], ['freelance-offers']) && in_array($subscriber->getName(), ['Sasha', 'Petya'])
                            || in_array($channel['name'], ['vk-offers']) && $subscriber->getName() === 'Valera')
                            <div class="flex items-center gap-2 text-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-{{ $channel['color'] }}-300"></span>
                                <span class="text-gray-700 font-medium">{{ $subscriber->getName() }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>

    {{-- Подписчики и их уведомления --}}
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Полученные уведомления</h2>
    <div class="grid grid-cols-4 gap-4 mb-8">
        @foreach($subscribers as $subscriber)
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h3 class="font-semibold text-gray-700 mb-3 pb-2 border-b border-gray-100">{{ $subscriber->getName() }}</h3>
                @if(count($subscriber->getNotifications()) > 0)
                    <div class="space-y-2">
                        @foreach($subscriber->getNotifications() as $notification)
                            <div class="bg-gray-50 rounded p-2 text-sm text-gray-600">
                                {{ $notification }}
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-400">Нет уведомлений</p>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Лог подписок --}}
    <div class="grid grid-cols-2 gap-6">

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Лог подписок</h2>
            <div class="space-y-2">
                @foreach($subscriptions as $msg)
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-green-500 font-mono text-xs">subscribe</span>
                        <span class="text-gray-600">{{ $msg }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Как работает --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Как работает</h2>
            <div class="space-y-3 text-sm text-gray-600">
                <div class="flex gap-2">
                    <span class="text-gray-400 font-mono shrink-0">EventChannel</span>
                    <span>центральный канал — хранит подписки и маршрутизирует сообщения</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-blue-500 font-mono shrink-0">Publisher</span>
                    <span>издатель — публикует данные в канал по определённой теме</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-green-500 font-mono shrink-0">Subscriber</span>
                    <span>подписчик — получает уведомления через notify()</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-purple-500 font-mono shrink-0">subscribe()</span>
                    <span>привязывает подписчика к теме в канале</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-orange-500 font-mono shrink-0">publish()</span>
                    <span>отправляет данные всем подписчикам темы</span>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-gray-100">
                <p class="text-xs text-gray-400 font-mono leading-relaxed">
                    Publisher &rarr; EventChannel.publish(topic, data)<br>
                    EventChannel &rarr; Subscriber.notify(data)<br>
                    Subscriber &larr; получает только свои темы
                </p>
            </div>
        </div>

    </div>

    {{-- Примеры кода --}}
    <h2 class="text-lg font-semibold text-gray-800 mt-10 mb-4">Примеры кода</h2>

    <div class="space-y-4">

        <x-code-window language="php" filename="Использование">
$channel = new EventChannel();

// Создаём издателей по темам
$kwork     = new Publisher('kWork-offers', $channel);
$freelance = new Publisher('freelance-offers', $channel);
$vk        = new Publisher('vk-offers', $channel);

// Создаём подписчиков
$vova  = new Subscriber('Vova');
$sasha = new Subscriber('Sasha');
$petya = new Subscriber('Petya');

// Подписываем на темы
$channel->subscribe('kWork-offers', $vova);       // Vova подписан на kWork
$channel->subscribe('freelance-offers', $sasha);  // Sasha подписана на freelance
$channel->subscribe('freelance-offers', $petya);  // Petya подписан на freelance

// Публикуем — каждый получит только свои темы
$kwork->publish('New offer Kwork.ru');         // получит только Vova
$freelance->publish('New offer Freelance.ru'); // получат Sasha и Petya
$vk->publish('New offer VK.ru');               // никто не получит — нет подписчиков

print_r($vova->getNotifications());  // ['New offer Kwork.ru']
print_r($sasha->getNotifications()); // ['New offer Freelance.ru']
        </x-code-window>

        <x-code-window language="php" filename="EventChannelInterface.php">
interface EventChannelInterface
{
    public function subscribe($topic, SubscriberInterface $subscriber);

    public function publish($topic, $data);
}
        </x-code-window>

        <x-code-window language="php" filename="EventChannel.php">
// Центральный канал — хранит все подписки в массиве по темам
// При публикации проходит по всем подписчикам темы и вызывает notify()
class EventChannel implements EventChannelInterface
{
    private array $topics = [];

    public function subscribe($topic, SubscriberInterface $subscriber): string
    {
        $this->topics[$topic][] = $subscriber;

        return "{$subscriber->getName()} подписан(-а) на канал {$topic}";
    }

    public function publish($topic, $data): void
    {
        if (empty($this->topics[$topic])) {
            return;
        }

        foreach ($this->topics[$topic] as $subscriber) {
            $subscriber->notify($data); // уведомляем каждого подписчика
        }
    }
}
        </x-code-window>

        <x-code-window language="php" filename="Publisher.php">
// Издатель знает только свою тему и канал
// Не знает ничего про подписчиков
class Publisher implements PublisherInterface
{
    public function __construct(
        private string $topic,
        private EventChannelInterface $eventChannel,
    ) {}

    public function publish($data): void
    {
        $this->eventChannel->publish($this->topic, $data);
    }
}
        </x-code-window>

        <x-code-window language="php" filename="Subscriber.php">
// Подписчик получает уведомления через notify()
// Хранит историю полученных данных
class Subscriber implements SubscriberInterface
{
    private array $notifications = [];

    public function __construct(private string $name) {}

    public function notify($data): string
    {
        $this->notifications[] = $data;

        return "{$this->name} оповещен(а) данными {$data}";
    }

    public function getName(): string { return $this->name; }

    public function getNotifications(): array { return $this->notifications; }
}
        </x-code-window>

    </div>

@endsection
