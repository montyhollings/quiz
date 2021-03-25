<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use \App\Http\Controllers\QuizController;
use \App\Http\Controllers\QuizQuestionController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('administration')->name('admin.')->group(function () {
    Route::prefix('/users/')->name('users.')->group(function () {
         Route::get('/', [AdminController::class, 'index'])->name('index');
         Route::get('/edit/{user}', [AdminController::class, 'edit'])->name('edit');
         Route::post('/save/{user}', [AdminController::class, 'save'])->name('save');
         Route::get('/new', [AdminController::class, 'new_user'])->name('new');
         Route::post('/submit_new_user', [AdminController::class, 'submit_new_user'])->name('submit_new_user');
         Route::get('/delete/{user}', [AdminController::class, 'delete_modal'])->name('delete_modal');
         Route::post('/delete/{user}/submit', [AdminController::class, 'submit_delete'])->name('submit_delete');
     });
});

Route::prefix('quizzes')->name('quizzes.')->group(function () {
    Route::get('/', [QuizController::class, 'index'])->name('index');
    Route::get('/new', [QuizController::class, 'new_quiz'])->name('new');
    Route::get('/view/{quiz}', [QuizController::class, 'view'])->name('view');
    Route::post('/submit_new_quiz', [QuizController::class, 'submit_new_quiz'])->name('submit_new_quiz');
    Route::get('/edit/{quiz}', [QuizController::class, 'edit'])->name('edit');
    Route::post('/save/{quiz}', [QuizController::class, 'save'])->name('save');
    Route::get('/delete/{quiz}', [QuizController::class, 'delete_modal'])->name('delete_modal');
    Route::post('/delete/{quiz}/submit', [QuizController::class, 'submit_delete'])->name('submit_delete');
    Route::prefix('/{quiz}/questions')->name('questions.')->group(function () {
        Route::get('/new', [QuizQuestionController::class, 'new_question'])->name('new');
        Route::get('/view/{question}', [QuizQuestionController::class, 'view'])->name('view');
        Route::post('/submit_new_question', [QuizQuestionController::class, 'submit_new_question'])->name('submit_new_question');
        Route::get('/edit/{question}', [QuizQuestionController::class, 'edit'])->name('edit');
        Route::post('/save/{question}', [QuizQuestionController::class, 'save'])->name('save');
        Route::get('/delete/{question}', [QuizQuestionController::class, 'delete_modal'])->name('delete_modal');
        Route::post('/delete/{question}/submit', [QuizQuestionController::class, 'submit_delete'])->name('submit_delete');
    });

});

require __DIR__.'/auth.php';

Auth::routes();


