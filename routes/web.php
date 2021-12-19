<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
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
    
    Route::get('search/student', [StudentController::class, 'search']);
    Route::post('/student/grade', [StudentController::class, 'studentGrade'])->name('student.grade');
    
    Route::get('/student', [StudentController::class, 'index'])->name('student');
    Route::post('/student', [StudentController::class, 'store'])->name('student.store');
    Route::get('/student/add', [StudentController::class, 'add'])->name('student.add');
    Route::get('/student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::post('/student/update', [StudentController::class, 'update'])->name('student.update');
    Route::post('/student/delete', [StudentController::class, 'delete'])->name('student.delete');
    
    Route::post('/remove/student', [ClassesController::class, 'removeStudent'])->name('remove.student');
    Route::post('/remove/subject', [ClassesController::class, 'removeSubject'])->name('remove.subject');

    Route::get('/student/{classId}/{studentId}/grades', [StudentController::class, 'grades'])->name('student.grades');
   
    
    Route::get('/rank/admin', [RankingController::class, 'index'])->name('rank.admin');

    Route::get('/classes', [ClassesController::class, 'index'])->name('classes');
    

    Route::post('/classes', [RankingController::class, 'store'])->name('rank.store');
    Route::get('/classes/admin', [ClassesController::class, 'index'])->name('classes.admin');
    Route::get('/classes/admin/add', [ClassesController::class, 'add'])->name('classes.add');
    Route::post('/classes', [ClassesController::class, 'store'])->name('classes.store');
    Route::get('/classes/{id}/edit', [ClassesController::class, 'edit'])->name('classes.edit');
    Route::post('/classes/update', [ClassesController::class, 'update'])->name('classes.update');
    Route::post('/classes/delete', [ClassesController::class, 'delete'])->name('classes.delete');

    Route::get('/classes/{id}/classview', [ClassesController::class, 'classview'])->name('classes.classview');
    
    Route::resource('subject',SubjectController::class);
    Route::resource('users', UserController::class);

    Route::get('search/subject', [SubjectController::class, 'search']);

    Route::get('get/ranking/table', [RankingController::class, 'ranking']);

});
//OUT OF REACH
Route::group(['middleware' => ['auth:students']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/rank', [RankingController::class, 'index'])->name('rank');
    Route::get('/classes', [ClassesController::class, 'index'])->name('classes');
});


//REVIEW Middleware auth students AND BELOW
//logoutcontroller
//logincontroller

//CREATE RANKING AND CLASS FOLLOW STUDENT TABLE AND CLASS 

//get show
//post input add
//update registercontroller duplicate entry error
//register email exist update


//navbar mobile view side not function

