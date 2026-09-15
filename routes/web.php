<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


//kelompok route yang boleh di akses nya setelah login
    Route::middleware(['IsLoggedIn'])->group(function () {
        Route::get('/logout', [UserController::class, 'logout'])
            ->name('logout');
    });

//kelompok route yang boleh di akses nya sebelum login
Route::middleware(['IsGuest'])->group(function () {

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    // Route::httpmethod('/path', [Nama controller::class, 'NamaFunction']->name('');
    // namaController di import di atas dengan use
    Route::post('/register', [UserController::class, 'register'])
        ->name('register.store'); //abis titik (.) itu akan menjalan kan apa yang kita ketik kayak .store .show itu tuh tindakan yang akan di jalankan  

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [UserController::class, 'login'])
        ->name('login.store');
});
