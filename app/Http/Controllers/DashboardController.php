<?php

namespace App\Http\Controllers;

use App\Models\LostFoundItem;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'total' => LostFoundItem::count(),
            'lost' => LostFoundItem::where('type', 'lost')->count(),
            'found' => LostFoundItem::where('type', 'found')->count(),
            'active' => LostFoundItem::where('status', 'active')->count(),
            'claimed' => LostFoundItem::where('status', 'claimed')->count(),
            'returned' => LostFoundItem::where('status', 'returned')->count(),
        ];

        $recentItems = LostFoundItem::latest()->take(10)->get();
        $categories = LostFoundItem::selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        return view('dashboard.index', compact('stats', 'recentItems', 'categories'));
    }
}
