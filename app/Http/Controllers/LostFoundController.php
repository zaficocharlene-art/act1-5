<?php

namespace App\Http\Controllers;

use App\Models\LostFoundItem;
use Illuminate\Http\Request;

class LostFoundController extends Controller
{
    private array $categories = [
        'electronics' => '📱 Electronics',
        'clothing' => '👕 Clothing',
        'accessories' => '👜 Accessories',
        'documents' => '📄 Documents',
        'keys' => '🔑 Keys',
        'bags' => '🎒 Bags & Wallets',
        'pets' => '🐾 Pets',
        'sports' => '⚽ Sports & Outdoors',
        'books' => '📚 Books & Stationery',
        'jewelry' => '💍 Jewelry & Watches',
        'tools' => '🔧 Tools',
        'other' => '📦 Other',
    ];

    private function stats()
    {
        return [
            'total' => LostFoundItem::count(),
            'lost' => LostFoundItem::where('type', 'lost')->count(),
            'found' => LostFoundItem::where('type', 'found')->count(),
            'active' => LostFoundItem::where('status', 'active')->count(),
            'claimed' => LostFoundItem::where('status', 'claimed')->count(),
            'returned' => LostFoundItem::where('status', 'returned')->count(),
        ];
    }

    public function home()
    {
        $items = LostFoundItem::latest()->take(6)->get();
        $stats = $this->stats();

        return view('lostfound.home', compact('items', 'stats'));
    }

    public function board(Request $request)
    {
        $query = LostFoundItem::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('contact_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        match ($request->get('sort', 'newest')) {
            'oldest' => $query->oldest(),
            'name' => $query->orderBy('title'),
            default => $query->latest(),
        };

        $items = $query->paginate(9)->withQueryString();
        $categories = $this->categories;

        return view('lostfound.board', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = $this->categories;

        return view('lostfound.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:lost,found',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:50',
            'reward' => 'nullable|string|max:255',
        ]);

        if ($validated['type'] === 'found') {
            $validated['reward'] = null;
        }

        LostFoundItem::create($validated);

        return redirect()->route('board')->with('success', '📌 Item has been pinned to the community board!');
    }

    public function show(LostFoundItem $item)
    {
        return view('lostfound.show', compact('item'));
    }

    public function dashboard()
    {
        $items = LostFoundItem::latest()->get();
        $stats = $this->stats();

        $topCategories = LostFoundItem::selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $returnRate = $stats['total'] > 0
            ? round((($stats['claimed'] + $stats['returned']) / $stats['total']) * 100)
            : 0;

        return view('lostfound.dashboard', compact('items', 'stats', 'topCategories', 'returnRate'));
    }

    public function updateStatus(Request $request, LostFoundItem $item)
    {
        $request->validate([
            'status' => 'required|in:active,claimed,returned',
        ]);

        $item->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status updated successfully!');
    }

    public function destroy(LostFoundItem $item)
    {
        $item->delete();

        return redirect()->route('board')->with('info', 'Item removed from the board.');
    }
}