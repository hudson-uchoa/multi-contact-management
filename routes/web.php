<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('home', fn () => redirect()->route('home'));

Route::middleware('auth')->group(function () {
    Route::prefix('people')->name('people.')->group(function () {
        Route::get('create', [PersonController::class, 'create'])->name('create');
        Route::post('', [PersonController::class, 'store'])->name('store');
        Route::get('edit/{person}', [PersonController::class, 'edit'])
            ->where('person', '[0-9]+')
            ->name('edit');
        Route::put('update/{person}', [PersonController::class, 'update'])
            ->where('person', '[0-9]+')
            ->name('update');
        Route::delete('{person}', [PersonController::class, 'destroy'])
            ->where('person', '[0-9]+')
            ->name('destroy');
    });

    Route::prefix('contacts')->name('contacts.')->group(function () {
        Route::get('create/{person}', [ContactController::class, 'create'])
            ->where('person', '[0-9]+')
            ->name('create');
        Route::post('{person}', [ContactController::class, 'store'])
            ->where('person', '[0-9]+')
            ->name('store');
        Route::get('edit/{contact}', [ContactController::class, 'edit'])
            ->where('contact', '[0-9]+')
            ->name('edit');
        Route::put('update/{contact}', [ContactController::class, 'update'])
            ->where('contact', '[0-9]+')
            ->name('update');
        Route::delete('{contact}', [ContactController::class, 'destroy'])
            ->where('contact', '[0-9]+')
            ->name('destroy');
    });
});

Route::prefix('people')->name('people.')->group(function () {
    Route::get('', [PersonController::class, 'index'])->name('index');
    Route::get('{person}', [PersonController::class, 'show'])
        ->where('person', '[0-9]+')
        ->name('show');
});

Route::prefix('contacts')->name('contacts.')->group(function () {
    Route::get('', [ContactController::class, 'index'])->name('index');
    Route::get('summary', [ContactController::class, 'summaryByCountry'])->name('summary');
    Route::get('{contact}', [ContactController::class, 'show'])
        ->where('contact', '[0-9]+')
        ->name('show');
});
