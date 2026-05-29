<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GamerController extends Controller
{
    public function dashboard()
    {
        $reactions = session('reactions', []);
        return view('dashboard', compact('reactions'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'game' => 'required',
            'reaction' => 'required',
            'play_style' => 'required',
        ]);

        $data = [
            'id' => rand(1000, 9999),
            'name' => $request->name,
            'game' => $request->game,
            'reaction' => $request->reaction,
            'play_style' => $request->play_style,
        ];

        $reactions = session()->get('reactions', []);
        $reactions[] = $data;

        session(['reactions' => $reactions]);

        return redirect('/dashboard')->with('success', 'Gamer reaction saved!');
    }

    public function delete($id)
    {
        $reactions = session('reactions', []);

        $reactions = array_filter($reactions, function ($r) use ($id) {
            return $r['id'] != $id;
        });

        session(['reactions' => array_values($reactions)]);

        return redirect('/dashboard')->with('success', 'Deleted successfully!');
    }
}