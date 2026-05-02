<?php

namespace App\Http\Controllers;

use App\Models\Novel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NovelController extends Controller
{
    // Eto yung nagpapakita ng Form sa screen
    public function create()
    {
        return Inertia::render('Novels/Create');
    }

    // Eto yung mismong 'novel.store' command
    public function store(Request $request)
    {
        // 1. Validation - sinisiguro na may laman ang title
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // 2. Pag-save sa Database
        // Ikakabit nito ang novel sa kung sino ang kasalukuyang naka-login na user
        $request->user()->novels()->create($validated);

        // 3. Pagkatapos ma-save, ibabalik ka nito sa Dashboard
        return redirect()->route('dashboard');
    }
    // NovelController.php
public function showManuscript(Novel $novel) {
    return Inertia::render('Novels/Manuscript', [
        'novel' => $novel->load(['chapters' => function($query) {
            $query->orderBy('created_at', 'asc');
        }]),
    ]);
}
}
