<?php

use App\Http\Controllers\MitraProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::resource('mitra', MitraProfileController::class)->parameters([
    'mitra' => 'mitraProfile',
]);
