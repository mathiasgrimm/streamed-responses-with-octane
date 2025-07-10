<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/chat', function () {
    return response()->stream(function (): void {
        for ($i = 0; $i < 100; $i++) {
            echo "message {$i}<br>\n";
            ob_flush();
            flush();
            sleep(2); // Simulate delay between chunks...
        }
    }, 200, ['X-Accel-Buffering' => 'no']);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
