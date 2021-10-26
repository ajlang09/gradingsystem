<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', function() {
    return view('posts.home');
})->name('home');



Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');




Route::group(['middleware' => ['auth','web']], function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts');
    Route::post('/posts', [PostController::class, 'store']);
    
    Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::post('/student', [StudentController::class, 'store'])->name('student.store');
    Route::get('/student/add', [StudentController::class, 'add'])->name('student.add');
    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::post('/student/update', [StudentController::class, 'update'])->name('student.update');
    Route::post('/student/delete', [StudentController::class, 'delete'])->name('student.delete');
    
    Route::get('/rank', [RankingController::class, 'index'])->name('rank');
    Route::post('/classes', [RankingController::class, 'store'])->name('rank.store');
    Route::get('/classes', [ClassesController::class, 'index'])->name('classes');
    Route::post('/classes', [ClassesController::class, 'store'])->name('classes.store');

});

Route::group(['middleware' => ['auth:students']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/rank', [RankingController::class, 'index'])->name('rank');
    Route::get('/classes', [ClassesController::class, 'index'])->name('classes');
});




//get show
//post input add


