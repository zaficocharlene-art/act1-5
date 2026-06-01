<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
    @foreach($items as $item)
        @php
            $isLost = $item->type === 'lost';
            $emoji = [
                'electronics' => '📱', 'clothing' => '👕', 'accessories' => '👜', 'documents' => '📄',
                'keys' => '🔑', 'bags' => '🎒', 'pets' => '🐾', 'sports' => '⚽',
                'books' => '📚', 'jewelry' => '💍', 'tools' => '🔧', 'other' => '📦'
            ][$item->category] ?? '📦';
        @endphp

        <div class="bg-white rounded-2xl shadow-sm border-2 overflow-hidden transition-all hover:shadow-lg hover:-translate-y-1 {{ $isLost ? 'border-rose-100 hover:border-rose-200' : 'border-emerald-100 hover:border-emerald-200' }}">
            <div class="px-5 py-3 flex items-center justify-between {{ $isLost ? 'bg-gradient-to-r from-rose-500 to-red-500' : 'bg-gradient-to-r from-emerald-500 to-teal-500' }}">
                <span class="text-white font-bold text-sm">{{ $isLost ? '🔴 Lost Item' : '🟢 Found Item' }}</span>

                <span class="px-2.5 py-1 rounded-full text-xs font-bold border
                    {{ $item->status === 'active' ? 'bg-amber-100 text-amber-800 border-amber-200' : ($item->status === 'claimed' ? 'bg-blue-100 text-blue-800 border-blue-200' : 'bg-green-100 text-green-800 border-green-200') }}">
                    {{ $item->status === 'active' ? '🔔 Active' : ($item->status === 'claimed' ? '🤝 Claimed' : '🎉 Returned!') }}
                </span>
            </div>

            <div class="p-5">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <h3 class="font-extrabold text-gray-900 text-lg leading-tight">{{ $item->title }}</h3>
                    <span class="text-3xl flex-shrink-0 animate-float">{{ $emoji }}</span>
                </div>

                <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">{{ $item->description }}</p>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center gap-2 text-sm text-gray-500">📍 <span class="truncate">{{ $item->location }}</span></div>
                    <div class="flex items-center gap-2 text-sm text-gray-500">📅 <span>{{ $item->date->format('M d, Y') }}</span></div>

                    @if($item->reward)
                        <div class="flex items-center gap-2 text-sm font-bold text-amber-600 bg-amber-50 px-3 py-1.5 rounded-lg w-fit">
                            🎁 Reward: {{ $item->reward }}
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-3 pt-3 border-t border-dashed border-gray-200 mb-4">
                    <div class="w-9 h-9 rounded-full bg-emerald-500 flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr($item->contact_name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">{{ $item->contact_name }}</p>
                        <p class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('items.show', $item) }}" class="flex-1 text-center bg-gray-900 hover:bg-gray-800 text-white px-4 py-2.5 rounded-xl text-sm font-bold">
                        👁 View Details
                    </a>

                    <form method="POST" action="{{ route('items.destroy', $item) }}" onsubmit="return confirm('Remove this item from the board?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-50 hover:bg-red-100 text-red-500 px-3 py-2.5 rounded-xl text-sm font-bold">
                            🗑
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>