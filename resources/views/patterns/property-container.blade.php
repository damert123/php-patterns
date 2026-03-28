@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('patterns.index') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">← Паттерны</a>
    </div>

    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $name }}</h1>
    <p class="text-gray-500 text-sm mb-8">
        Паттерн позволяет динамически добавлять произвольные свойства к объекту без изменения его класса.
    </p>

    <div class="grid grid-cols-3 gap-6">

        {{-- Основные поля объекта --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Основные поля</h2>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">title</span>
                    <span class="font-medium text-gray-800">{{ $item->getTitle() }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">category_id</span>
                    <span class="font-medium text-gray-800">{{ $item->getCategoryId() }}</span>
                </div>
            </div>
        </div>

        {{-- Динамические свойства --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Динамические свойства</h2>
            <div class="space-y-3">
                @foreach($item->getProperties() as $key => $value)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">{{ $key }}</span>
                        <span class="font-medium text-gray-800">{{ $value }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Как работает --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Как работает</h2>
            <ul class="space-y-2 text-sm text-gray-600">
                <li class="flex gap-2"><span class="text-green-500 font-mono">add</span> добавляет свойство</li>
                <li class="flex gap-2"><span class="text-blue-500 font-mono">update</span> обновляет существующее</li>
                <li class="flex gap-2"><span class="text-red-500 font-mono">delete</span> удаляет свойство</li>
                <li class="flex gap-2"><span class="text-gray-500 font-mono">get</span> читает значение</li>
            </ul>
        </div>

    </div>

    {{-- Примеры кода --}}
    <h2 class="text-lg font-semibold text-gray-800 mt-10 mb-4">Примеры кода</h2>

    <div class="space-y-4">

        <x-code-window language="php" filename="Использование">
$post = new BlogPost();

// Фиксированные поля — заданы в классе
$post->setTitle('Заголовок статьи');
$post->setCategoryId(10);

// Динамические свойства — добавляем на лету без изменения класса
$post->addProperty('view_count', 100);
$post->addProperty('last_update', '2030-02-01');

$post->updateProperty('last_update', '2025-02-01'); // обновляем
$post->addProperty('read_only', true);
$post->deleteProperty('read_only');                 // удаляем

echo $post->getProperty('view_count'); // 100
        </x-code-window>

        <x-code-window language="php" filename="PropertyContainerInterface.php">
interface PropertyContainerInterface
{
    public function addProperty($propertyName, $value): void;

    public function deleteProperty($propertyName): void;

    public function getProperty($propertyName): mixed;

    public function updateProperty($propertyName, $value): void;
}
        </x-code-window>

        <x-code-window language="php" filename="PropertyContainer.php">
class PropertyContainer implements PropertyContainerInterface
{
    private array $propertyContainer = [];

    public function addProperty($propertyName, $value): void
    {
        $this->propertyContainer[$propertyName] = $value;
    }

    public function deleteProperty($propertyName): void
    {
        unset($this->propertyContainer[$propertyName]);
    }

    public function getProperty($propertyName): mixed
    {
        return $this->propertyContainer[$propertyName] ?? null;
    }

    public function updateProperty($propertyName, $value): void
    {
        if (!isset($this->propertyContainer[$propertyName])) {
            throw new \Exception("Property [{$propertyName}] not found");
        }

        $this->propertyContainer[$propertyName] = $value;
    }
}
        </x-code-window>

        <x-code-window language="php" filename="BlogPost.php">
// Конкретный класс — наследует контейнер свойств
// Имеет свои фиксированные поля (title, category_id)
// + наследует возможность динамически добавлять любые другие
class BlogPost extends PropertyContainer
{
    private string $title;
    private int $category_id;

    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }

    public function getCategoryId(): int { return $this->category_id; }
    public function setCategoryId(int $categoryId): void { $this->category_id = $categoryId; }
}
        </x-code-window>

    </div>

    <div class="mt-8">
        @php dump($item) @endphp
    </div>

@endsection
