<?php

namespace App\Http\Controllers;
use App\Models\Novel; // <--- DAPAT MAY GANITO
use App\Models\Chapter;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function create(Novel $novel)
{
    return Inertia::render('Chapters/ChapterCreate', [
        'novel' => $novel
    ]);
}
public function store(Request $request)
{
    // 1. I-validate ang data (Standard IT practice)
    $validated = $request->validate([
        'novel_id' => 'required|exists:novels,id',
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'chapter_number' => 'required|integer',
    ]);

    // 2. I-save sa database
    Chapter::create($validated);

    // 3. Bumalik sa dashboard o listahan
    return redirect()->route('dashboard')->with('message', 'Chapter draft saved strategically!');
}
}
