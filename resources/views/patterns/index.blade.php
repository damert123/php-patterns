@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-8">Паттерны</h1>

    <div class="space-y-10">
        @foreach($categories as $category)
            <div>
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $category['name'] }}</h2>
                    <p class="text-sm text-gray-400">{{ $category['description'] }}</p>
                </div>

                <div class="grid grid-cols-4 gap-4">
                    @foreach($category['patterns'] as $pattern)
                        <a href="{{ $pattern['url'] }}"
                           class="bg-white rounded-lg p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all">
                            <h3 class="font-semibold text-gray-800">{{ $pattern['name'] }}</h3>
                        </a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
