<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\SubscriptionPackageController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;

// Route '/' cukup didefinisikan sekali. Route closure duplikat sebelumnya hanya
// mengirim $subscriptionPackages, sehingga $latestBooks tidak tersedia di home.blade.php.

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');


//kelompok route yang boleh di akses nya setelah login
Route::middleware(['IsLoggedIn'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // Prefix untuk mengelompokan route ad  min yang path nya di awali dengan /admin 
    // Seluruh route pada kelompok ini akan memiliki nama route yang di awali dengan admin. contoh: admin.dashboard
    // Route::middleware(['IsAdmin'])->group(function () {
    Route::prefix('admin')->name('admin.')->middleware(['IsAdmin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        //resource route untuk mengelola data kategori buku yang otomatis membuat semua method CRUD (create, read, update, delete) untuk resource book-categories
        Route::resource('book-categories', BookCategoryController::class);
        Route::resource('subscription-packages', SubscriptionPackageController::class);

        Route::resource('books', BookController::class);
    });
    // });

});

//kelompok route yang boleh di akses nya sebelum login
Route::middleware(['IsGuest'])->group(function () {

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    // Route::httpmethod('/path', [Nama controller::class, 'NamaFunction']->name('');
    // namaController di import di atas dengan use
    Route::post('/register', [UserController::class, 'register'])
        ->name('register.store')->middleware('throttle:5,1'); //abis titik (.) itu akan menjalan kan apa yang kita ketik kayak .store .show itu tuh tindakan yang akan di jalankan  

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [UserController::class, 'login'])
        ->name('login.store')->middleware('throttle:5,1');
});

// Route::middleware(['IsAdmin'])->group(function () {});
