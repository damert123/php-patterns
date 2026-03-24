@extends('layouts.app')

@section('content')
    <div class="flex items-center gap-12">

        <div class="w-1/2">
            <h1 class="text-3xl font-bold text-gray-800 mb-3">PHP Design Patterns</h1>
            <p class="text-gray-500 text-base mb-8">
                Коллекция паттернов проектирования на PHP с живыми примерами. Каждый паттерн реализован
                по-настоящему — без упрощений, с правильной структурой классов и разделением ответственности.
            </p>

            <div class="grid grid-cols-1 gap-3 mb-10">
                <div class="bg-white rounded-lg p-5 shadow-sm border-l-4 border-blue-400">
                    <h3 class="font-semibold text-gray-800 mb-1">Фундаментальные паттерны</h3>
                    <p class="text-sm text-gray-500">Базовые паттерны: делегирование, контейнер свойств и другие — основа грамотной архитектуры.</p>
                </div>
            </div>

            <a href="{{ route('patterns.index') }}"
               class="inline-flex items-center gap-2 bg-gray-900 text-white px-6 py-3 rounded-lg text-sm font-medium hover:bg-gray-700 transition">
                Смотреть паттерны →
            </a>
        </div>

        <div class="w-1/2">
            <svg viewBox="0 0 480 340" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
                <defs>
                    <filter id="shadow" x="-5%" y="-5%" width="115%" height="115%">
                        <feDropShadow dx="0" dy="4" stdDeviation="12" flood-color="#00000030"/>
                    </filter>
                </defs>

                <!-- Основной фон -->
                <rect x="0" y="0" width="480" height="340" rx="14" fill="#1e1e2e" filter="url(#shadow)"/>

                <!-- Шапка -->
                <rect x="0" y="0" width="480" height="42" rx="14" fill="#181825"/>
                <rect x="0" y="28" width="480" height="14" fill="#181825"/>
                <circle cx="24" cy="21" r="6" fill="#fc6058"/>
                <circle cx="44" cy="21" r="6" fill="#fec02f"/>
                <circle cx="64" cy="21" r="6" fill="#2aca44"/>

                <!-- Имя файла -->
                <text x="210" y="26" font-family="monospace" font-size="11" fill="#6c7086" text-anchor="middle">AppMessenger.php</text>

                <!-- Номера строк -->
                <text x="22" y="74"  font-family="monospace" font-size="11" fill="#45475a">1</text>
                <text x="22" y="94"  font-family="monospace" font-size="11" fill="#45475a">2</text>
                <text x="22" y="114" font-family="monospace" font-size="11" fill="#45475a">3</text>
                <text x="22" y="134" font-family="monospace" font-size="11" fill="#45475a">4</text>
                <text x="22" y="154" font-family="monospace" font-size="11" fill="#45475a">5</text>
                <text x="22" y="174" font-family="monospace" font-size="11" fill="#45475a">6</text>
                <text x="22" y="194" font-family="monospace" font-size="11" fill="#45475a">7</text>
                <text x="22" y="214" font-family="monospace" font-size="11" fill="#45475a">8</text>
                <text x="22" y="234" font-family="monospace" font-size="11" fill="#45475a">9</text>
                <text x="14" y="254" font-family="monospace" font-size="11" fill="#45475a">10</text>
                <text x="14" y="274" font-family="monospace" font-size="11" fill="#45475a">11</text>
                <text x="14" y="294" font-family="monospace" font-size="11" fill="#45475a">12</text>
                <text x="14" y="314" font-family="monospace" font-size="11" fill="#45475a">13</text>

                <!-- Разделитель номеров -->
                <line x1="44" y1="48" x2="44" y2="340" stroke="#313244" stroke-width="1"/>

                <!-- Строки кода -->
                <!-- 1: class AppMessenger implements MessengerInterface -->
                <text x="54" y="74" font-family="monospace" font-size="12" fill="#cba6f7">class</text>
                <text x="96" y="74" font-family="monospace" font-size="12" fill="#cdd6f4">AppMessenger</text>
                <text x="200" y="74" font-family="monospace" font-size="12" fill="#cba6f7">implements</text>
                <text x="289" y="74" font-family="monospace" font-size="12" fill="#89dceb">MessengerInterface</text>

                <!-- 2: { -->
                <text x="54" y="94" font-family="monospace" font-size="12" fill="#6c7086">{</text>

                <!-- 3: private MessengerInterface $messenger; -->
                <text x="70" y="114" font-family="monospace" font-size="12" fill="#cba6f7">private</text>
                <text x="120" y="114" font-family="monospace" font-size="12" fill="#89dceb">MessengerInterface</text>
                <text x="252" y="114" font-family="monospace" font-size="12" fill="#cdd6f4">$messenger;</text>

                <!-- 4: (пустая) -->

                <!-- 5: public function toSms(): static -->
                <text x="70" y="154" font-family="monospace" font-size="12" fill="#cba6f7">public function</text>
                <text x="188" y="154" font-family="monospace" font-size="12" fill="#89b4fa">toSms</text>
                <text x="228" y="154" font-family="monospace" font-size="12" fill="#6c7086">():</text>
                <text x="252" y="154" font-family="monospace" font-size="12" fill="#cba6f7">static</text>

                <!-- 6: { -->
                <text x="70" y="174" font-family="monospace" font-size="12" fill="#6c7086">{</text>

                <!-- 7:     $this->messenger = new SmsMessenger(); -->
                <text x="86" y="194" font-family="monospace" font-size="12" fill="#cdd6f4">$this-></text>
                <text x="142" y="194" font-family="monospace" font-size="12" fill="#cdd6f4">messenger</text>
                <text x="218" y="194" font-family="monospace" font-size="12" fill="#6c7086">=</text>
                <text x="230" y="194" font-family="monospace" font-size="12" fill="#cba6f7">new</text>
                <text x="258" y="194" font-family="monospace" font-size="12" fill="#89dceb">SmsMessenger</text>
                <text x="362" y="194" font-family="monospace" font-size="12" fill="#6c7086">();</text>

                <!-- 8:     return $this; -->
                <text x="86" y="214" font-family="monospace" font-size="12" fill="#cba6f7">return</text>
                <text x="134" y="214" font-family="monospace" font-size="12" fill="#cdd6f4">$this;</text>

                <!-- 9: } -->
                <text x="70" y="234" font-family="monospace" font-size="12" fill="#6c7086">}</text>

                <!-- 10: (пустая) -->

                <!-- 11: public function send(): string|bool -->
                <text x="70" y="274" font-family="monospace" font-size="12" fill="#cba6f7">public function</text>
                <text x="188" y="274" font-family="monospace" font-size="12" fill="#89b4fa">send</text>
                <text x="216" y="274" font-family="monospace" font-size="12" fill="#6c7086">():</text>
                <text x="240" y="274" font-family="monospace" font-size="12" fill="#cba6f7">string</text>
                <text x="285" y="274" font-family="monospace" font-size="12" fill="#6c7086">|</text>
                <text x="294" y="274" font-family="monospace" font-size="12" fill="#cba6f7">bool</text>

                <!-- 12: { -->
                <text x="70" y="294" font-family="monospace" font-size="12" fill="#6c7086">{</text>

                <!-- 13:     return $this->messenger->send(); -->
                <text x="86" y="314" font-family="monospace" font-size="12" fill="#cba6f7">return</text>
                <text x="134" y="314" font-family="monospace" font-size="12" fill="#cdd6f4">$this->messenger-></text>
                <text x="296" y="314" font-family="monospace" font-size="12" fill="#89b4fa">send</text>
                <text x="324" y="314" font-family="monospace" font-size="12" fill="#6c7086">();</text>

                <!-- курсор -->
                <rect x="348" y="303" width="2" height="14" rx="1" fill="#cdd6f4" opacity="0.7"/>
            </svg>
        </div>

    </div>
@endsection
