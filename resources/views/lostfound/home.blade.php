@extends('layouts.lostfound')

@section('content')
@php
    $returnRate = $stats['total'] > 0 ? round((($stats['claimed'] + $stats['returned']) / $stats['total']) * 100) : 0;
@endphp

<div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-500">
    <div class="absolute -top-20 -right-20 w-80 h-80 bg-amber-400/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-teal-300/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4 py-16 sm:py-24">
        <div class="text-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 bg-white/20 text-white px-5 py-2 rounded-full text-sm font-medium mb-6 border border-white/20">
                ✨ Neighbors helping neighbors since day one
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                Lost Something?<br>
                <span class="text-amber-300">Your Neighbors</span><br>
                Are Here to Help
            </h1>

            <p class="text-lg sm:text-xl text-emerald-50 mb-10 max-w-2xl mx-auto leading-relaxed">
                Our community board connects neighbors who've lost items with those who've found them.
                Together, we look out for each other. 💛
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('items.create') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-amber-400 text-amber-900 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-amber-300 transition-all shadow-lg">
                    ⚠️ I Lost Something
                </a>
                <a href="{{ route('board', ['type' => 'found']) }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-white/20 text-white border-2 border-white/40 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/30 transition-all">
                    🔍 I Found Something
                </a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 -mt-4 mb-12">
    <div class="bg-white rounded-3xl shadow-lg border border-amber-100 p-6 sm:p-8">
        <div class="text-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Our Community Impact</h2>
            <p class="text-sm text-gray-500 mt-1">Real neighbors, real results 🤝</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <div class="text-center p-4 bg-emerald-50 rounded-2xl">
                <div class="text-3xl mb-1">📋</div>
                <p class="text-3xl font-extrabold text-emerald-700">{{ $stats['total'] }}</p>
                <p class="text-sm text-emerald-600 font-medium">Items Posted</p>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-2xl">
                <div class="text-3xl mb-1">🔍</div>
                <p class="text-3xl font-extrabold text-red-600">{{ $stats['lost'] }}</p>
                <p class="text-sm text-red-500 font-medium">Looking For</p>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-2xl">
                <div class="text-3xl mb-1">🎉</div>
                <p class="text-3xl font-extrabold text-green-600">{{ $stats['found'] }}</p>
                <p class="text-sm text-green-500 font-medium">Found Items</p>
            </div>
            <div class="text-center p-4 bg-amber-50 rounded-2xl">
                <div class="text-3xl mb-1">💛</div>
                <p class="text-3xl font-extrabold text-amber-600">{{ $returnRate }}%</p>
                <p class="text-sm text-amber-500 font-medium">Reunited!</p>
            </div>
        </div>
    </div>
</div>

<div class="board-bg py-16 border-y-4 border-dashed border-amber-300">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-amber-900">📌 Community Board</h2>
                <p class="text-amber-700/70">Latest posts from your neighbors</p>
            </div>
            <a href="{{ route('board') }}" class="hidden sm:flex text-amber-700 hover:text-amber-800 font-bold bg-amber-200/60 px-4 py-2 rounded-xl">
                See Full Board →
            </a>
        </div>

        @include('lostfound.partials.cards', ['items' => $items])
    </div>
</div>
@endsection