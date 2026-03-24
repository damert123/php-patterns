<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

    <nav class="bg-gray-900 h-14 flex items-center px-10">
        <div class="flex-1">
            <a href="/" class="text-white font-semibold text-lg">{{ config('app.name') }}</a>
        </div>

        <ul class="flex gap-2 list-none">
            <li>
                <a href="{{ route('patterns.index') }}" class="text-gray-400 hover:text-white hover:bg-white/10 px-4 py-1.5 rounded text-sm transition">
                    Паттерны
                </a>
            </li>
        </ul>

        <div class="flex-1"></div>
    </nav>

    <div class="w-4/5 mx-auto py-8">
        @yield('content')
    </div>

</body>
</html>
