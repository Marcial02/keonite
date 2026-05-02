<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\NovelController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'novels' => auth()->user()->novels()->latest()->get()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/create', [NovelController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
// Idagdag mo rin ito para sa submit button:
Route::post('/novels', [NovelController::class, 'store'])->middleware(['auth', 'verified'])->name('novels.store');

// view manuscript
Route::get('/novels/{novel}/manuscript', [NovelController::class, 'showManuscript'])->name('novels.manuscript');

// Page para magsulat ng bagong chapter
Route::get('/novels/{novel}/chapters/create', [ChapterController::class, 'create'])
    ->name('chapters.create'); // <--- DAPAT SAKTO ITONG PANGALAN NA 'TO

// Command para i-save ang chapter
Route::post('/chapters', [ChapterController::class, 'store'])->name('chapters.store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Artisan;

Route::get('/init-db', function () {
    // Ang --force ay kailangan dahil APP_ENV=production ang Hostinger mo
    Artisan::call('migrate --force');
    return "Database migration successful!";
});
