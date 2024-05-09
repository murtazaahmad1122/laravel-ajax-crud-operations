<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('AdminController')->group(function(){
    Route::get('admin/login', [AdminController::class, 'loginFrom']);
    Route::Post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});
Route::middleware([
    'auth:sanctum, admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('admin/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

   

});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('employees', EmployeeController::class);

});
