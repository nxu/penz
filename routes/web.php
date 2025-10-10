<?php

use App\Http\Controllers\EntryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['signed'])->group(function () {
    Route::get('/entry/{user}', [EntryController::class, 'form'])->name('entry.form');
    Route::post('/entry/{user}', [EntryController::class, 'save'])->name('entry.submit');
});
