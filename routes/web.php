<?php

use App\Http\Controllers\SendController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::guest()) {
        return redirect('/login');
    } else {
        return redirect('/home');
    }
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::group(['middleware' => ['role:manager']], function () {
    Route::get('/manager', [SendController::class, 'showManager'])->name('manager');
    Route::post('/change', [SendController::class, 'change'])->name('change');
});

Route::group(['middleware' => ['role:user']], function () {
    Route::post('/send', [SendController::class, 'send'])->name('send');
    Route::get('/send', function () {
        return view('home');
    });
});



