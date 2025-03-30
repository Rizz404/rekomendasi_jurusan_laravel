<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollegeMajorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name('home');

// ! hati-hati positioning nya karena bisa ke campur id
Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');
// * Auto buatin semua route berdasarkan flag resource, kalo nambahin sisanya buat sendiri
Route::resource('students', StudentController::class);

Route::get('/criterias/search', [CriteriaController::class, 'search'])->name('criterias.search');
Route::resource('criterias', CriteriaController::class);

Route::middleware('guest')->group(function ()
{
    // * Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // * Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::resource('college-majors', CollegeMajorController::class);
