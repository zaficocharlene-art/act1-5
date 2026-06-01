<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NeighborsHelp - Community Lost & Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @keyframes slide-in {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        .animate-slide-in { animation: slide-in .3s ease-out; }
        .animate-float { animation: float 3s ease-in-out infinite; }

        .board-bg {
            background-color: #fef3c7;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(251, 191, 36, .08) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(245, 158, 11, .06) 0%, transparent 50%);
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>

<body class="min-h-screen bg-amber-50/30 font-sans">

<nav class="bg-gradient-to-r from-emerald-700 via-emerald-600 to-teal-600 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 text-white font-bold text-xl">
                <div class="bg-white/20 p-2 rounded-xl">💚</div>
                <div>
                    <span class="block text-lg leading-tight font-extrabold">NeighborsHelp</span>
                    <span class="block text-[10px] text-emerald-200 leading-tight -mt-0.5">Community Lost & Found</span>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-emerald-100 hover:bg-white/15 hover:text-white">🏠 Home</a>
                <a href="{{ route('board') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-emerald-100 hover:bg-white/15 hover:text-white">🔍 Community Board</a>
                <a href="{{ route('items.create') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-emerald-100 hover:bg-white/15 hover:text-white">➕ Post Item</a>
                <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl text-sm font-medium text-emerald-100 hover:bg-white/15 hover:text-white">📊 Insights</a>
            </div>

            <div class="hidden md:flex items-center gap-2 bg-amber-400/90 text-amber-900 px-3 py-1.5 rounded-full text-xs font-bold">
                👥 Community Strong
            </div>
        </div>
    </div>
</nav>

@if(session('success') || session('info'))
    <div class="fixed top-20 right-4 z-50 animate-slide-in max-w-sm">
        <div class="px-5 py-3.5 rounded-2xl shadow-xl text-white font-bold text-sm border-2
            {{ session('success') ? 'bg-emerald-500 border-emerald-400' : 'bg-blue-500 border-blue-400' }}">
            {{ session('success') ?? session('info') }}
        </div>
    </div>
@endif

<main>
    @yield('content')
</main>

<footer class="bg-gradient-to-r from-emerald-800 to-teal-800 text-emerald-200 py-10 mt-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-col items-center gap-4 text-center">
            <div class="flex items-center gap-2 text-white font-extrabold text-xl">💚 NeighborsHelp</div>
            <p class="text-sm text-emerald-300 max-w-md">
                A community-powered lost & found board. Because neighbors look out for each other. 💛
            </p>
            <div class="flex items-center gap-6 text-xs text-emerald-400">
                <span>🏡 Community First</span>
                <span>🤝 Always Free</span>
                <span>💚 Neighbor Powered</span>
            </div>
            <p class="text-xs text-emerald-500 mt-2">© {{ date('Y') }} NeighborsHelp Community Lost & Found</p>
        </div>
    </div>
</footer>

</body>
</html>