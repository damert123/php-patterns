@extends('layouts.app')

@section('content')

    <div class="mb-6">
        <a href="{{ route('patterns.index') }}" class="text-sm text-gray-400 hover:text-gray-600 transition">← Паттерны</a>
    </div>

    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $name }}</h1>
    <p class="text-gray-500 text-sm mb-8">
        Объект передаёт выполнение задачи другому объекту. AppMessenger не знает как отправить — он делегирует это EmailMessenger или SmsMessenger.
    </p>

    <div class="grid grid-cols-3 gap-6">

        {{-- Email демо --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                <h2 class="font-semibold text-gray-700">EmailMessenger</h2>
            </div>
            <div class="space-y-3 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">sender</span>
                    <span class="font-medium text-gray-800">sender@mail.ru</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">recipient</span>
                    <span class="font-medium text-gray-800">recipient@mail.ru</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">message</span>
                    <span class="font-medium text-gray-800">Hello email messenger</span>
                </div>
            </div>
            <div class="bg-blue-50 rounded p-3 text-sm">
                <span class="text-blue-400 font-mono text-xs">send()</span>
                <p class="text-blue-700 font-medium mt-1">{{ $emailResult }}</p>
            </div>
        </div>

        {{-- SMS демо --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                <h2 class="font-semibold text-gray-700">SmsMessenger</h2>
            </div>
            <div class="space-y-3 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">sender</span>
                    <span class="font-medium text-gray-800">89178239146</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">recipient</span>
                    <span class="font-medium text-gray-800">84324023423</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">message</span>
                    <span class="font-medium text-gray-800">Hello SMS messenger</span>
                </div>
            </div>
            <div class="bg-green-50 rounded p-3 text-sm">
                <span class="text-green-400 font-mono text-xs">send()</span>
                <p class="text-green-700 font-medium mt-1">{{ $smsResult }}</p>
            </div>
        </div>

        {{-- Как работает --}}
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="font-semibold text-gray-700 mb-4 pb-2 border-b border-gray-100">Как работает</h2>
            <div class="space-y-3 text-sm text-gray-600">
                <div class="flex gap-2">
                    <span class="text-gray-400 font-mono shrink-0">AppMessenger</span>
                    <span>не отправляет сам — держит ссылку на реального отправителя</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-purple-500 font-mono shrink-0">toEmail()</span>
                    <span>переключает делегата на EmailMessenger</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-purple-500 font-mono shrink-0">toSms()</span>
                    <span>переключает делегата на SmsMessenger</span>
                </div>
                <div class="flex gap-2">
                    <span class="text-orange-500 font-mono shrink-0">send()</span>
                    <span>вызывает send() у текущего делегата</span>
                </div>
            </div>

            <div class="mt-5 pt-4 border-t border-gray-100">
                <p class="text-xs text-gray-400 font-mono leading-relaxed">
                    AppMessenger → messenger→send()<br>
                    AppMessenger → messenger→setSender()<br>
                    AppMessenger → messenger→setMessage()
                </p>
            </div>
        </div>

    </div>

    <div class="mt-8">
        @php dump($item) @endphp
    </div>

@endsection
