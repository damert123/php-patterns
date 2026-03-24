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

    <div class="mt-8">
        @php dump($item) @endphp
    </div>

@endsection
