@extends('layouts.lostfound')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8 space-y-6">
    <div>
        <div class="flex items-center gap-2">
            <span class="text-3xl">📌</span>
            <h1 class="text-3xl font-extrabold text-gray-900">Community Board</h1>
        </div>
        <p class="text-gray-500 mt-1 ml-11">{{ $items->total() }} posts on the board</p>
    </div>

    <form method="GET" action="{{ route('board') }}" class="space-y-4">
        <div class="relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search the community board..."
                class="w-full pl-5 pr-5 py-4 rounded-2xl border-2 border-emerald-100 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 text-gray-900 placeholder-gray-400 text-lg"
            >
        </div>

        <div class="flex flex-col lg:flex-row gap-3 justify-between">
            <div class="flex items-center bg-gray-100 rounded-xl p-1">
                @foreach(['all' => '📋 All', 'lost' => '🔴 Lost', 'found' => '🟢 Found'] as $value => $label)
                    <a href="{{ route('board', array_merge(request()->except('page'), ['type' => $value])) }}"
                       class="px-5 py-2.5 rounded-lg text-sm font-bold transition-all
                       {{ request('type', 'all') === $value ? ($value === 'lost' ? 'bg-rose-500 text-white' : ($value === 'found' ? 'bg-emerald-500 text-white' : 'bg-white text-gray-900')) : 'text-gray-500 hover:text-gray-700' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-2">
                <select name="category" class="px-3 py-2.5 rounded-xl border-2 border-gray-200 bg-white text-sm">
                    <option value="all">All Categories</option>
                    @foreach($categories as $key => $label)
                        <option value="{{ $key }}" @selected(request('category') === $key)>{{ $label }}</option>
                    @endforeach
                </select>

                <select name="status" class="px-3 py-2.5 rounded-xl border-2 border-gray-200 bg-white text-sm">
                    <option value="all">All Statuses</option>
                    <option value="active" @selected(request('status') === 'active')>🔔 Active</option>
                    <option value="claimed" @selected(request('status') === 'claimed')>🤝 Claimed</option>
                    <option value="returned" @selected(request('status') === 'returned')>🎉 Returned</option>
                </select>

                <select name="sort" class="px-3 py-2.5 rounded-xl border-2 border-gray-200 bg-white text-sm">
                    <option value="newest" @selected(request('sort', 'newest') === 'newest')>Newest First</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>Oldest First</option>
                    <option value="name" @selected(request('sort') === 'name')>Name A-Z</option>
                </select>

                <button class="bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold px-5">
                    Filter
                </button>
            </div>
        </div>
    </form>

    @if($items->count())
        @include('lostfound.partials.cards', ['items' => $items])
        <div>{{ $items->links() }}</div>
    @else
        <div class="text-center py-16 bg-white rounded-3xl border-2 border-dashed border-amber-200">
            <div class="text-6xl mb-4">📌</div>
            <h3 class="text-xl font-extrabold text-gray-900 mb-1">Board is empty here!</h3>
            <p class="text-gray-500 text-sm mb-4">Try adjusting your search or filters.</p>
            <a href="{{ route('board') }}" class="text-emerald-600 hover:text-emerald-700 font-bold text-sm">Clear all filters</a>
        </div>
    @endif
</div>
@endsection