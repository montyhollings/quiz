<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('administration')->name('admin.')->group(function () {
    Route::prefix('/users/')->name('users.')->group(function () {
        Route::get('/', [\App\Http\Controllers\AdministrationController::class, 'index'])->name('index');
        Route::get('/edit/{user}', [\App\Http\Controllers\AdministrationController::class, 'edit'])->name('edit');
        Route::post('/save/{user}', [\App\Http\Controllers\AdministrationController::class, 'save'])->name('save');
        Route::post('/submit_new_user', [\App\Http\Controllers\AdministrationController::class, 'submit_new_user'])->name('submit_new_user');
    });
});
