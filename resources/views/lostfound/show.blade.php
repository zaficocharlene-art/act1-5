@extends('layouts.lostfound')

@section('content')
@php
    $isLost = $item->type === 'lost';
    $emoji = [
        'electronics' => '📱', 'clothing' => '👕', 'accessories' => '👜', 'documents' => '📄',
        'keys' => '🔑', 'bags' => '🎒', 'pets' => '🐾', 'sports' => '⚽',
        'books' => '📚', 'jewelry' => '💍', 'tools' => '🔧', 'other' => '📦'
    ][$item->category] ?? '📦';
@endphp

<div class="max-w-3xl mx-auto px-4 py-8">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="px-6 py-5 flex items-center justify-between {{ $isLost ? 'bg-gradient-to-r from-rose-500 to-red-500' : 'bg-gradient-to-r from-emerald-500 to-teal-500' }}">
            <div>
                <span class="text-white/80 text-xs uppercase tracking-wider font-bold">
                    {{ $isLost ? '🔴 Lost Item' : '🟢 Found Item' }}
                </span>
                <h2 class="text-white font-extrabold text-2xl leading-tight">{{ $item->title }}</h2>
            </div>

            <a href="{{ route('board') }}" class="text-white/90 hover:text-white text-2xl">×</a>
        </div>

        <div class="p-6 space-y-6">
            <div class="flex flex-wrap items-center gap-2">
                <span class="px-3 py-1.5 rounded-full text-sm font-bold
                    {{ $item->status === 'active' ? 'bg-amber-100 text-amber-800' : ($item->status === 'claimed' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                    {{ $item->status === 'active' ? '🔔 Active' : ($item->status === 'claimed' ? '🤝 Claimed' : '🎉 Returned!') }}
                </span>

                <span class="px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-700">
                    {{ $emoji }} {{ $item->category }}
                </span>

                @if($item->reward)
                    <span class="px-3 py-1.5 rounded-full text-sm font-bold bg-amber-100 text-amber-800">
                        🎁 Reward: {{ $item->reward }}
                    </span>
                @endif
            </div>

            <div class="bg-amber-50 rounded-2xl p-5 border border-amber-100">
                <h3 class="text-xs font-bold text-amber-600 uppercase tracking-wider mb-2">📝 Description</h3>
                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $item->description }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-xs text-gray-400 font-bold">Location</p>
                    <p class="font-semibold text-gray-900 text-sm">📍 {{ $item->location }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-xs text-gray-400 font-bold">Date</p>
                    <p class="font-semibold text-gray-900 text-sm">📅 {{ $item->date->format('D, M d, Y') }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-xl">
                    <p class="text-xs text-gray-400 font-bold">Posted</p>
                    <p class="font-semibold text-gray-900 text-sm">🕒 {{ $item->created_at->format('M d, Y h:i A') }}</p>
                </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-6 border border-emerald-100">
                <h3 class="text-sm font-bold text-emerald-700 mb-4">🤝 Contact This Neighbor</h3>

                <div class="flex items-center gap-4 mb-4">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-500 flex items-center justify-center text-white text-lg font-bold">
                        {{ strtoupper(substr($item->contact_name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="font-extrabold text-gray-900 text-lg">{{ $item->contact_name }}</p>
                        <p class="text-sm text-emerald-600">Community Member</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="mailto:{{ $item->contact_email }}" class="flex items-center gap-3 p-3 bg-white rounded-xl hover:bg-emerald-50">
                        📧 <span class="font-semibold text-blue-600 text-sm">{{ $item->contact_email }}</span>
                    </a>

                    <a href="tel:{{ $item->contact_phone }}" class="flex items-center gap-3 p-3 bg-white rounded-xl hover:bg-emerald-50">
                        📞 <span class="font-semibold text-green-600 text-sm">{{ $item->contact_phone }}</span>
                    </a>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2 pt-3 border-t-2 border-dashed border-gray-200">
                @if($item->status === 'active')
                    <form method="POST" action="{{ route('items.status', $item) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="claimed">
                        <button class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold">
                            ✅ Mark as Claimed
                        </button>
                    </form>
                @endif

                @if($item->status === 'claimed')
                    <form method="POST" action="{{ route('items.status', $item) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="returned">
                        <button class="px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white rounded-xl text-sm font-bold">
                            🎉 Mark as Returned
                        </button>
                    </form>
                @endif

                @if($item->status !== 'active')
                    <form method="POST" action="{{ route('items.status', $item) }}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="active">
                        <button class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-sm font-bold">
                            🔄 Reactivate
                        </button>
                    </form>
                @endif

                <form method="POST" action="{{ route('items.destroy', $item) }}" class="ml-auto" onsubmit="return confirm('Remove this item from the community board?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-500 rounded-xl text-sm font-bold">
                        🗑 Remove
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection