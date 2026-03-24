@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Паттерны</h1>

    <div class="grid grid-cols-4 gap-4">
        @foreach($patterns as $pattern)
            <a href="{{ $pattern['url'] }}"
               class="bg-white rounded-lg p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                <h2 class="font-semibold text-gray-800">{{ $pattern['name'] }}</h2>
            </a>
        @endforeach
    </div>
@endsection
