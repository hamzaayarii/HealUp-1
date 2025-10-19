@extends('layouts.app')
@section('title', 'Recommended Events')
@section('content')
<div class="container py-8 mx-auto max-w-4xl">
    <h2 class="mb-8 text-2xl font-bold text-emerald-700 text-center flex items-center justify-center gap-2">
        <span>🤖</span> Recommended Events For You
    </h2>
    @if(count($recommended))
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($recommended as $event)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-6 flex flex-col justify-between transition hover:scale-[1.02] hover:shadow-lg">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-2xl">📅</span>
                            <span class="font-semibold text-lg text-gray-900 dark:text-gray-100">{{ $event['title'] }}</span>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                            <span class="font-medium">{{ $event['date'] }}</span>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300">{{ $event['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center py-8 text-lg">No recommendations found. Try participating in more events!</div>
    @endif
</div>
@endsection
