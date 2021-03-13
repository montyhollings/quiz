<?php

use App\Http\Controllers\HomeController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('administration')->name('admin.')->group(function () {
    Route::prefix('/users/')->name('users.')->group(function () {
         Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('index');
         Route::get('/edit/{user}', [App\Http\Controllers\AdminController::class, 'edit'])->name('edit');
        Route::post('/save/{user}', [App\Http\Controllers\AdminController::class, 'save'])->name('save');
        Route::get('/new', [App\Http\Controllers\AdminController::class, 'new_user'])->name('new');
        Route::post('/submit_new_user', [App\Http\Controllers\AdminController::class, 'submit_new_user'])->name('submit_new_user');
         Route::get('/delete/{user}', [App\Http\Controllers\AdminController::class, 'delete_modal'])->name('delete_modal');
         Route::post('/delete/{user}/submit', [App\Http\Controllers\AdminController::class, 'submit_delete'])->name('submit_delete');
     });
});



require __DIR__.'/auth.php';

Auth::routes();


