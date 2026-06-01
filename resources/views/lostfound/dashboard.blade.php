@extends('layouts.lostfound')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <span class="text-3xl">✨</span>
                <h1 class="text-3xl font-extrabold text-gray-900">Community Insights</h1>
            </div>
            <p class="text-gray-500 mt-1 ml-11">See how our neighborhood is making a difference 💚</p>
        </div>

        <a href="{{ route('items.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl font-bold">
            Post to Board →
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <div class="bg-gray-50 rounded-2xl p-5 text-center"><div class="text-3xl">📋</div><p class="text-2xl font-extrabold">{{ $stats['total'] }}</p><p class="text-sm text-gray-500">Total Posts</p></div>
        <div class="bg-rose-50 rounded-2xl p-5 text-center"><div class="text-3xl">🔴</div><p class="text-2xl font-extrabold text-rose-700">{{ $stats['lost'] }}</p><p class="text-sm text-rose-500">Lost Items</p></div>
        <div class="bg-emerald-50 rounded-2xl p-5 text-center"><div class="text-3xl">🟢</div><p class="text-2xl font-extrabold text-emerald-700">{{ $stats['found'] }}</p><p class="text-sm text-emerald-500">Found Items</p></div>
        <div class="bg-amber-50 rounded-2xl p-5 text-center"><div class="text-3xl">🔔</div><p class="text-2xl font-extrabold text-amber-700">{{ $stats['active'] }}</p><p class="text-sm text-amber-500">Active</p></div>
        <div class="bg-blue-50 rounded-2xl p-5 text-center"><div class="text-3xl">🤝</div><p class="text-2xl font-extrabold text-blue-700">{{ $stats['claimed'] }}</p><p class="text-sm text-blue-500">Claimed</p></div>
        <div class="bg-purple-50 rounded-2xl p-5 text-center"><div class="text-3xl">🎉</div><p class="text-2xl font-extrabold text-purple-700">{{ $stats['returned'] }}</p><p class="text-sm text-purple-500">Returned</p></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border-2 border-emerald-100 p-6">
            <h3 class="font-extrabold text-gray-900 mb-4">🛡 Reunion Rate</h3>
            <div class="flex items-center justify-center">
                <div class="w-36 h-36 rounded-full border-[14px] border-emerald-200 flex items-center justify-center">
                    <div class="text-center">
                        <span class="text-3xl font-extrabold text-gray-900">{{ $returnRate }}%</span>
                        <p class="text-xs text-gray-400">reunited</p>
                    </div>
                </div>
            </div>
            <p class="text-center text-sm text-gray-500 mt-4">
                {{ $stats['claimed'] + $stats['returned'] }} of {{ $stats['total'] }} items found their way home 💛
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border-2 border-amber-100 p-6">
            <h3 class="font-extrabold text-gray-900 mb-4">📈 What's Being Posted</h3>

            <div class="space-y-3">
                @forelse($topCategories as $cat)
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700 font-bold">{{ $cat->category }}</span>
                            <span class="text-gray-400 font-medium">{{ $cat->total }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3">
                            <div class="bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full h-3" style="width: {{ $stats['total'] > 0 ? ($cat->total / $stats['total']) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-400 text-sm">No items yet</p>
                @endforelse
            </div>
        </div>

        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl shadow-sm border-2 border-emerald-100 p-6">
            <h3 class="font-extrabold text-gray-900 mb-4">💚 Community Spirit</h3>

            <div class="space-y-3">
                <a href="{{ route('items.create') }}" class="block p-3 rounded-xl bg-white hover:bg-emerald-50 border border-emerald-100">
                    <p class="font-bold text-gray-900 text-sm">🤝 Report Lost Item</p>
                    <p class="text-xs text-gray-400">Ask neighbors for help</p>
                </a>

                <a href="{{ route('board') }}" class="block p-3 rounded-xl bg-white hover:bg-emerald-50 border border-emerald-100">
                    <p class="font-bold text-gray-900 text-sm">🔍 Browse Community Board</p>
                    <p class="text-xs text-gray-400">Look for possible matches</p>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border-2 border-gray-100 p-6">
        <h3 class="font-extrabold text-gray-900 mb-4">🕒 Recent Posts</h3>

        <div class="space-y-3">
            @forelse($items->take(5) as $item)
                <a href="{{ route('items.show', $item) }}" class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50">
                    <div>
                        <p class="font-bold text-gray-900">{{ $item->title }}</p>
                        <p class="text-sm text-gray-400">{{ ucfirst($item->type) }} • {{ $item->location }}</p>
                    </div>
                    <span class="text-xs px-3 py-1 rounded-full bg-amber-100 text-amber-700 font-bold">{{ $item->status }}</span>
                </a>
            @empty
                <p class="text-gray-400">No recent posts yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection