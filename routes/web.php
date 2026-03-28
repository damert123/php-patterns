<?php

use App\Http\Controllers\PatternsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('patterns')->name('patterns.')->group(function () {
    Route::get('/', [PatternsController::class, 'index'])->name('index');
    Route::get('/delegation', [PatternsController::class, 'delegation'])->name('delegation');
    Route::get('/property-container', [PatternsController::class, 'propertyContainer'])->name('property-container');
    Route::get('/event-channel', [PatternsController::class, 'eventChannel'])->name('event-channel');
    Route::get('/interface', [PatternsController::class, 'interfacePattern'])->name('interface');
    Route::get('/abstract-factory', [PatternsController::class, 'abstractFactory'])->name('abstract-factory');
});
