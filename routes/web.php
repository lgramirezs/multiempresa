<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantRegistersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        Route::resource('tenants', TenantController::class)->except(['show']);

        Route::get('/tenants-registers/{tenant}', [TenantRegistersController::class, 'index'])->name('tenants-registers.index');

        // Route::get('/file/{path}', function ($path) {
        //     return response()->file(Storage::path($path));
        // })->where('path', '.*') // Permite cualquier ruta después de /file/
        //     ->name('file');

        require __DIR__ . '/auth.php';
    });
}
