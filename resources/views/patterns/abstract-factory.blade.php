@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('patterns.index') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">&larr; Паттерны</a>
    </div>

    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $name }}</h1>
    <p class="text-gray-500 text-sm mb-8">
        Паттерн предоставляет интерфейс для создания <strong>семейств связанных объектов</strong>, не указывая их конкретных классов.
        Важно: это не PHP <span class="font-mono bg-gray-100 px-1.5 py-0.5 rounded text-xs">abstract class</span> — это паттерн проектирования.
        Слово «абстрактная» означает что фабрика работает через абстракции (интерфейсы), а не с конкретными классами напрямую.
    </p>

    {{-- Две фабрики рядом --}}
    <div class="grid grid-cols-2 gap-6 mb-8">

        {{-- Bootstrap --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100">
                <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                <h2 class="font-semibold text-gray-700">BootstrapFactory</h2>
            </div>

            <div class="space-y-3">
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-xs text-gray-400 font-mono mb-1">buildButtons()->draw()</p>
                    <p class="text-sm font-medium text-gray-800">{{ $bootstrapButton->draw() }}</p>
                </div>
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-xs text-gray-400 font-mono mb-1">buildCheckBox()->draw()</p>
                    <p class="text-sm font-medium text-gray-800">{{ $bootstrapCheckBox->draw() }}</p>
                </div>
            </div>
        </div>

        {{-- SemanticUI --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100">
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <h2 class="font-semibold text-gray-700">SemanticUiFactory</h2>
            </div>

            <div class="space-y-3">
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-xs text-gray-400 font-mono mb-1">buildButtons()->draw()</p>
                    <p class="text-sm font-medium text-gray-800">{{ $semanticButton->draw() }}</p>
                </div>
                <div class="bg-gray-50 rounded p-3">
                    <p class="text-xs text-gray-400 font-mono mb-1">buildCheckBox()->draw()</p>
                    <p class="text-sm font-medium text-gray-800">{{ $semanticCheckBox->draw() }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Суть + не путать --}}
    <div class="grid grid-cols-2 gap-6 mb-8">

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Как работает</h2>
            <div class="space-y-3 text-sm text-gray-600">
                <div class="flex gap-2">
                    <span class="text-purple-500 font-mono shrink-0">GuiKitFactory</span>
                    <span>решает какую конкретную фабрику вернуть по типу ('bootstrap', 'semanticui')</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-blue-500 font-mono shrink-0">GuiFactoryInterface</span>
                    <span>общий контракт для всех фабрик — buildButtons() и buildCheckBox()</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-green-500 font-mono shrink-0">BootstrapFactory</span>
                    <span>создаёт Bootstrap-компоненты, реализует интерфейс</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-teal-500 font-mono shrink-0">SemanticUiFactory</span>
                    <span>создаёт SemanticUI-компоненты, тот же интерфейс</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-orange-500 font-mono shrink-0">Клиент</span>
                    <span>работает только с интерфейсом — не знает какой именно класс создаётся</span>
                </div>
            </div>
            <div class="mt-5 pt-4 border-t border-gray-100 text-xs text-gray-400 font-mono leading-relaxed">
                GuiKitFactory::getFactory('bootstrap')<br>
                &rarr; BootstrapFactory implements GuiFactoryInterface<br>
                &rarr; buildButtons() &rarr; ButtonBootstrap<br>
                &rarr; buildCheckBox() &rarr; CheckBoxBootstrap
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
            <h2 class="font-semibold text-gray-700 mb-3">Паттерн vs PHP <code class="bg-gray-200 px-1.5 py-0.5 rounded text-sm">abstract class</code></h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Паттерн «Абстрактная фабрика»</p>
                    <p class="text-sm text-gray-500">Архитектурное решение — группа фабричных методов за общим интерфейсом. Про создание семейств объектов. Классы могут быть вполне конкретными.</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">PHP <code class="text-sm bg-gray-200 px-1 rounded">abstract class</code></p>
                    <p class="text-sm text-gray-500">Языковая конструкция — нельзя создать экземпляр напрямую, используется как базовый класс для наследования. Это про ООП, не про паттерны.</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Примеры кода --}}
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Примеры кода</h2>

    <div class="space-y-4">

        <x-code-window language="php" filename="Использование">
// Клиент работает только с интерфейсом — не знает какой класс создаётся
$factory = (new GuiKitFactory())->getFactory('bootstrap');

$button   = $factory->buildButtons();   // вернёт ButtonBootstrap
$checkbox = $factory->buildCheckBox();  // вернёт CheckBoxBootstrap

echo $button->draw();   // App\Patterns\AbstractFactory\ButtonBootstrap
echo $checkbox->draw(); // App\Patterns\AbstractFactory\CheckBoxBootstrap

// Меняем фабрику — код выше не меняется
$factory = (new GuiKitFactory())->getFactory('semanticui');

$button   = $factory->buildButtons();   // теперь ButtonSemanticUi
$checkbox = $factory->buildCheckBox();  // теперь CheckBoxSemanticUi
        </x-code-window>

        <x-code-window language="php" filename="Interfaces/GuiFactoryInterface.php">
interface GuiFactoryInterface
{
    public function buildButtons(): ButtonInterface;

    public function buildCheckBox(): CheckBoxInterface;
}
        </x-code-window>

        <x-code-window language="php" filename="Factory/BootstrapFactory.php">
class BootstrapFactory implements GuiFactoryInterface
{
    public function buildButtons(): ButtonInterface
    {
        return new ButtonBootstrap();
    }

    public function buildCheckBox(): CheckBoxInterface
    {
        return new CheckBoxBootstrap();
    }
}
        </x-code-window>

        <x-code-window language="php" filename="Factory/GuiKitFactory.php">
class GuiKitFactory
{
    public function getFactory(string $type): GuiFactoryInterface
    {
        return match($type) {
            'bootstrap'  => new BootstrapFactory(),
            'semanticui' => new SemanticUiFactory(),
            default      => throw new \Exception("Неизвестный тип фабрики {$type}"),
        };
    }
}
        </x-code-window>

    </div>

@endsection
