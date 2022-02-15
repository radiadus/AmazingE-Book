<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\EBookController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// untuk semua
Route::get('/', function () {
    return view('index');
});

Route::get('/logoutsuccess', function(){ return view('logoutsuccess');});

Auth::routes();

// untuk admin
Route::middleware('admin')->group(function(){
    Route::get('/maintenance', [AccountController::class, 'showProfileMaintenance']);
    Route::get('/updaterole/{id}', [AccountController::class, 'updateRole']);
    Route::put('/savingrole/{id}', [AccountController::class, 'savingRole']);
    Route::put('/delete-account/{id}', [AccountController::class, 'deleteAccount']);
});

// untuk user
Route::middleware('user')->group(function(){
    // tidak ada
});

// untuk auth
Route::middleware('auth')->group(function(){
    Route::get('/home', [EBookController::class, 'show']);

    Route::get('/ebookdetail/{id}', [EBookController::class, 'getEBook']);
    Route::post('/ebookdetail/{id}', [OrderController::class, 'rent']);

    Route::get('/cart', [OrderController::class, 'showCart']);

    Route::get('/success', function(){ return view('success');});

    Route::get('/profile', [AccountController::class, 'showProfile']);
    Route::post('/profile', [AccountController::class, 'updateProfile']);

    Route::get('/saved', function(){ return view('saved');});

    Route::post('/delete-account/{{$s->account_id}}', [AccountController::class, 'deleteAccount']);

    Route::get('/updaterole', function(){ return view('updaterole');});

    Route::post('/deletecart/{id}', [OrderController::class, 'delete']);

    Route::post('/submit', [OrderController::class, 'submit']);

    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
});



if (file_exists(app_path('Http/Controllers/LocalizationController.php')))
{
    Route::get('lang/{locale}', [App\Http\Controllers\LocalizationController::class , 'languages']);
    Route::get('/lang/{locale}', [App\Http\Controllers\LocalizationController::class , 'languages']);
}

