@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('patterns.index') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">&larr; Паттерны</a>
    </div>

    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $name }}</h1>
    <p class="text-gray-500 text-sm mb-8">
        Паттерн определяет интерфейс для создания объекта, но <strong>позволяет дочерним классам решить</strong>, какой именно класс создавать.
        Родительский класс делегирует создание объекта подклассам через абстрактный метод.
    </p>

    {{-- Две формы рядом --}}
    <div class="grid grid-cols-2 gap-6 mb-8">

        {{-- Bootstrap --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100">
                <span class="w-2 h-2 rounded-full bg-purple-400"></span>
                <h2 class="font-semibold text-gray-700">BootstrapDialogForm</h2>
            </div>

            <p class="text-xs text-gray-400 font-mono mb-3">render() &rarr; createGuiKit() &rarr; BootstrapFactory</p>

            <div class="space-y-3">
                @foreach($bootstrapResult as $line)
                    <div class="bg-gray-50 rounded p-3">
                        <p class="text-sm font-medium text-gray-800">{{ $line }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- SemanticUI --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-2 mb-5 pb-3 border-b border-gray-100">
                <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                <h2 class="font-semibold text-gray-700">SemanticDialogForm</h2>
            </div>

            <p class="text-xs text-gray-400 font-mono mb-3">render() &rarr; createGuiKit() &rarr; SemanticUiFactory</p>

            <div class="space-y-3">
                @foreach($semanticResult as $line)
                    <div class="bg-gray-50 rounded p-3">
                        <p class="text-sm font-medium text-gray-800">{{ $line }}</p>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    {{-- Суть + отличие от Abstract Factory --}}
    <div class="grid grid-cols-2 gap-6 mb-8">

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Как работает</h2>
            <div class="space-y-3 text-sm text-gray-600">
                <div class="flex gap-2">
                    <span class="text-purple-500 font-mono shrink-0">AbstractForm</span>
                    <span>содержит метод render(), который вызывает createGuiKit() — но не знает какую фабрику вернут</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-blue-500 font-mono shrink-0">createGuiKit()</span>
                    <span>абстрактный метод — каждый подкласс решает сам, какую фабрику создать</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-green-500 font-mono shrink-0">BootstrapDialogForm</span>
                    <span>возвращает BootstrapFactory из createGuiKit()</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-teal-500 font-mono shrink-0">SemanticDialogForm</span>
                    <span>возвращает SemanticUiFactory из createGuiKit()</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-orange-500 font-mono shrink-0">Клиент</span>
                    <span>вызывает render() — не знает какая фабрика внутри</span>
                </div>
            </div>
            <div class="mt-5 pt-4 border-t border-gray-100 text-xs text-gray-400 font-mono leading-relaxed">
                $form = new BootstrapDialogForm();<br>
                $form->render()<br>
                &rarr; createGuiKit() &rarr; BootstrapFactory<br>
                &rarr; buildCheckBox()->draw()<br>
                &rarr; buildButtons()->draw()
            </div>
        </div>

        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
            <h2 class="font-semibold text-gray-700 mb-3">Фабричный метод vs Абстрактная фабрика</h2>
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Фабричный метод (Factory Method)</p>
                    <p class="text-sm text-gray-500">Один абстрактный метод в родительском классе. Дочерний класс переопределяет его и решает, какой объект создать. Фокус на <strong>одном</strong> методе создания.</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Абстрактная фабрика (Abstract Factory)</p>
                    <p class="text-sm text-gray-500">Интерфейс с несколькими фабричными методами для создания <strong>семейства</strong> связанных объектов. Фокус на группе объектов.</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Примеры кода --}}
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Примеры кода</h2>

    <div class="space-y-4">

        <x-code-window language="php" filename="Использование">
// Клиент не знает какая фабрика внутри — просто вызывает render()
$bootstrapForm = new BootstrapDialogForm();
$semanticForm  = new SemanticDialogForm();

$bootstrapForm->render();
// ['App\Patterns\AbstractFactory\CheckBoxBootstrap',
//  'App\Patterns\AbstractFactory\ButtonBootstrap']

$semanticForm->render();
// ['App\Patterns\AbstractFactory\CheckBoxSemanticUi',
//  'App\Patterns\AbstractFactory\ButtonSemanticUi']
        </x-code-window>

        <x-code-window language="php" filename="FormInterface.php">
interface FormInterface
{
    public function render(): array;
}
        </x-code-window>

        <x-code-window language="php" filename="AbstractForm.php">
// Родительский класс — содержит логику render(),
// но делегирует создание фабрики дочерним классам
abstract class AbstractForm implements FormInterface
{
    public function render(): array
    {
        $guiKit = $this->createGuiKit(); // вызов фабричного метода
        $result[] = $guiKit->buildCheckBox()->draw();
        $result[] = $guiKit->buildButtons()->draw();

        return $result;
    }

    // Фабричный метод — дочерний класс решает что создать
    abstract protected function createGuiKit(): GuiFactoryInterface;
}
        </x-code-window>

        <x-code-window language="php" filename="BootstrapDialogForm.php">
// Дочерний класс — переопределяет фабричный метод
class BootstrapDialogForm extends AbstractForm
{
    protected function createGuiKit(): GuiFactoryInterface
    {
        return new BootstrapFactory();
    }
}
        </x-code-window>

        <x-code-window language="php" filename="SemanticDialogForm.php">
// Другой дочерний класс — другая фабрика, та же логика render()
class SemanticDialogForm extends AbstractForm
{
    protected function createGuiKit(): GuiFactoryInterface
    {
        return new SemanticUiFactory();
    }
}
        </x-code-window>

    </div>

@endsection
