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
    return response()->eventStream(function () {
        if (!request()->has('message')) {
            return;
        };

        for ($i = 0; $i < 100; $i++) {
            yield "message {$i}<br>\n";
            sleep(2);
        }
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
