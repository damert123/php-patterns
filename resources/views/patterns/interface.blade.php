@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('patterns.index') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">&larr; Паттерны</a>
    </div>

    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $name }}</h1>
    <p class="text-gray-500 text-sm mb-8">
        Паттерн «Интерфейс» — это не ключевое слово <span class="font-mono text-gray-700">interface</span> в PHP.
        Это фундаментальный паттерн проектирования: класс, который предоставляет простые высокоуровневые методы,
        скрывая за ними сложную внутреннюю работу. Ты дёргаешь за один метод — а внутри происходит цепочка низкоуровневых вызовов.
    </p>

    {{-- Визуальная схема --}}
    <div class="grid grid-cols-3 gap-6 mb-8">

        {{-- Ты (клиент) --}}
        <div class="bg-white rounded-lg shadow-sm p-6 flex flex-col items-center justify-center text-center">
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mb-3">
                <span class="text-blue-600 text-lg font-bold">TЫ</span>
            </div>
            <h2 class="font-semibold text-gray-700 mb-2">Клиент</h2>
            <p class="text-sm text-gray-500">Вызываешь один простой метод и получаешь результат. Не знаешь что происходит внутри.</p>
            <div class="mt-4 bg-blue-50 rounded p-3 w-full">
                <code class="text-sm text-blue-700">$car->start();</code>
            </div>
        </div>

        {{-- Интерфейс (класс-фасад) --}}
        <div class="bg-gray-900 rounded-lg shadow-sm p-6 text-center">
            <div class="w-12 h-12 rounded-full bg-purple-500/20 flex items-center justify-center mb-3 mx-auto">
                <span class="text-purple-400 text-lg font-bold">I</span>
            </div>
            <h2 class="font-semibold text-white mb-2">Интерфейс (класс)</h2>
            <p class="text-sm text-gray-400 mb-4">Высокоуровневый метод, который оркестрирует работу внутренних компонентов.</p>
            <div class="bg-gray-800 rounded p-3 text-left text-xs font-mono leading-relaxed">
                <p class="text-white">public function <span class="text-blue-400">start</span>(): void</p>
                <p class="text-white">{</p>
                <p class="text-white pl-3">$this-><span style="color: #f472b6">engine</span>-><span class="text-blue-400">on</span>();</p>
                <p class="text-white pl-3">$this-><span style="color: #f472b6">lights</span>-><span class="text-blue-400">on</span>();</p>
                <p class="text-white pl-3">$this-><span style="color: #f472b6">dashboard</span>-><span class="text-blue-400">show</span>();</p>
                <p class="text-white pl-3">$this-><span style="color: #f472b6">fuel</span>-><span class="text-blue-400">check</span>();</p>
                <p class="text-white pl-3">$this-><span style="color: #f472b6">transmission</span>-><span class="text-blue-400">set</span>('D');</p>
                <p class="text-white">}</p>
            </div>
        </div>

        {{-- Внутренние компоненты --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 text-center">Скрытая сложность</h2>
            <div class="space-y-2">
                <div class="flex items-center gap-2 bg-red-50 rounded p-2.5">
                    <span class="w-2 h-2 rounded-full bg-red-400"></span>
                    <span class="text-sm font-mono text-red-700">Engine::on()</span>
                </div>
                <div class="flex items-center gap-2 bg-yellow-50 rounded p-2.5">
                    <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                    <span class="text-sm font-mono text-yellow-700">Lights::on()</span>
                </div>
                <div class="flex items-center gap-2 bg-green-50 rounded p-2.5">
                    <span class="w-2 h-2 rounded-full bg-green-400"></span>
                    <span class="text-sm font-mono text-green-700">Dashboard::show()</span>
                </div>
                <div class="flex items-center gap-2 bg-blue-50 rounded p-2.5">
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                    <span class="text-sm font-mono text-blue-700">FuelSystem::check()</span>
                </div>
                <div class="flex items-center gap-2 bg-purple-50 rounded p-2.5">
                    <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                    <span class="text-sm font-mono text-purple-700">Transmission::set('D')</span>
                </div>
            </div>
        </div>

    </div>

    {{-- Примеры из реального мира + объяснение --}}
    <div class="grid grid-cols-2 gap-6">

        {{-- Примеры --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Примеры в реальной жизни</h2>
            <div class="space-y-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-lg">🚗</span>
                        <span class="font-medium text-gray-700 text-sm">Автомобиль</span>
                    </div>
                    <p class="text-sm text-gray-500 pl-7">Поворот ключа зажигания — один жест. Внутри: стартер крутит двигатель, подаётся топливо, включается электроника, загорается приборная панель.</p>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-lg">☕</span>
                        <span class="font-medium text-gray-700 text-sm">Кофемашина</span>
                    </div>
                    <p class="text-sm text-gray-500 pl-7">Нажал кнопку «Капучино». Внутри: помол зёрен, нагрев воды, экстракция, взбивание молока, подача в чашку.</p>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-lg">📱</span>
                        <span class="font-medium text-gray-700 text-sm">Смартфон</span>
                    </div>
                    <p class="text-sm text-gray-500 pl-7">Нажал «Позвонить». Внутри: поиск сети, установка соединения, кодирование голоса, маршрутизация через базовые станции.</p>
                </div>
            </div>
        </div>

        {{-- Суть паттерна --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Суть паттерна</h2>
            <div class="space-y-3 text-sm text-gray-600">
                <div class="flex gap-2">
                    <span class="text-purple-500 font-mono shrink-0">Interface</span>
                    <span>класс с простыми методами, скрывающий сложную работу внутренних компонентов</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-blue-500 font-mono shrink-0">High-level</span>
                    <span>один вызов снаружи запускает цепочку действий внутри</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-green-500 font-mono shrink-0">Low-level</span>
                    <span>внутренние компоненты — реальные исполнители, о которых клиент не знает</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-orange-500 font-mono shrink-0">Инкапсуляция</span>
                    <span>детали реализации спрятаны — можно менять внутренности не ломая внешний код</span>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-gray-100">
                <h3 class="text-xs font-semibold text-gray-500 uppercase mb-2">Где встречается</h3>
                <div class="space-y-1 text-xs text-gray-400 font-mono leading-relaxed">
                    <p>Делегирование — AppMessenger скрывает Email/Sms</p>
                    <p>Фасад (Facade) — частный случай этого паттерна</p>
                    <p>Фабрика — скрывает логику создания объектов</p>
                    <p>Laravel Facade — Route::get() скрывает Router</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Ключевое отличие --}}
    <div class="mt-6 bg-gray-50 rounded-lg p-6 border border-gray-200">
        <h2 class="font-semibold text-gray-700 mb-3">Паттерн «Интерфейс» vs PHP <code class="bg-gray-200 px-1.5 py-0.5 rounded text-sm">interface</code></h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-medium text-gray-700 mb-1">Паттерн «Интерфейс»</p>
                <p class="text-sm text-gray-500">Конкретный <strong>класс</strong>, который предоставляет простые методы наружу и прячет сложность внутри. Это про архитектуру и разделение уровней абстракции.</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700 mb-1">PHP <code class="text-sm bg-gray-200 px-1 rounded">interface</code></p>
                <p class="text-sm text-gray-500">Языковая конструкция — контракт, описывающий какие методы должен реализовать класс. Это про полиморфизм и подменяемость.</p>
            </div>
        </div>
    </div>

@endsection
