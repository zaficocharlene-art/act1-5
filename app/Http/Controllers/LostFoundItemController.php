<?php

namespace App\Http\Controllers;

use App\Models\LostFoundItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LostFoundItemController extends Controller
{
    private array $categories = [
        'electronics', 'clothing', 'accessories', 'documents', 'keys',
        'bags', 'pets', 'sports', 'books', 'jewelry', 'tools', 'other'
    ];

    public function home()
    {
        $items = LostFoundItem::latest()->take(6)->get();
        $stats = $this->stats();
        return view('home', compact('items', 'stats'));
    }

    public function index(Request $request)
    {
        $items = LostFoundItem::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('contact_name', 'like', "%{$search}%");
                });
            })
            ->when($request->type && $request->type !== 'all', fn ($q) => $q->where('type', $request->type))
            ->when($request->category && $request->category !== 'all', fn ($q) => $q->where('category', $request->category))
            ->when($request->status && $request->status !== 'all', fn ($q) => $q->where('status', $request->status));

        match ($request->sortBy) {
            'oldest' => $items->oldest(),
            'name' => $items->orderBy('title'),
            default => $items->latest(),
        };

        $items = $items->paginate(9)->withQueryString();
        $categories = $this->categories;
        return view('items.index', compact('items', 'categories'));
    }

    public function create()
    {
        $categories = $this->categories;
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => ['required', Rule::in(['lost', 'found'])],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', Rule::in($this->categories)],
            'location' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:50'],
            'reward' => ['nullable', 'string', 'max:100'],
        ]);

        $validated['status'] = 'active';
        $item = LostFoundItem::create($validated);

        return redirect()->route('items.show', $item)->with('success', 'Item posted to the community board!');
    }

    public function show(LostFoundItem $item)
    {
        return view('items.show', compact('item'));
    }

    public function updateStatus(Request $request, LostFoundItem $item)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(['active', 'claimed', 'returned'])],
        ]);

        $item->update($validated);
        return back()->with('success', 'Item status updated successfully.');
    }

    public function destroy(LostFoundItem $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item removed from the board.');
    }

    private function stats(): array
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
}
