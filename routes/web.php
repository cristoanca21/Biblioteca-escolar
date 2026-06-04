<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CategoriaController;

Route::inertia('/', 'Welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('dashboard', function () {
        return \Inertia\Inertia::render('Dashboard', [
            'totalLibros' => \App\Models\Libro::count(),
            'totalCategorias' => \App\Models\Categoria::count(),
        ]);
    })->name('dashboard');

    Route::resource('libros', LibroController::class);
    Route::resource('categorias', CategoriaController::class);
});

require __DIR__ . '/settings.php';
