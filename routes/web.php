<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollegeMajorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\MajorCharacteristicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentScoreController;
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

Route::prefix('student-scores')->name('student-scores.')->group(function ()
{
    Route::get('/create-many', [StudentScoreController::class, 'createMany'])->name('create-many');
    Route::post('/store-many', [StudentScoreController::class, 'storeMany'])->name('store-many');
    Route::post('/delete-many', [StudentScoreController::class, 'deleteMany'])->name('delete-many');
});
Route::resource('student-scores', StudentScoreController::class);

// ! jangan lupa controller ya kadang kadang suka pake model lu!!!
Route::prefix('major-characteristics')->name('major-characteristics.')->group(function ()
{
    Route::get('/create-many', [MajorCharacteristicController::class, 'createMany'])->name('create-many');
    Route::post('/store-many', [MajorCharacteristicController::class, 'storeMany'])->name('store-many');
    Route::post('/delete-many', [MajorCharacteristicController::class, 'deleteMany'])->name('delete-many');
});
Route::get('/major-characteristics/create/{collegeMajor}', [MajorCharacteristicController::class, 'create'])
    ->name('major-characteristics.create');
// ! kalo misalnya ada yang diubah exclude dari default resource
Route::resource('major-characteristics', MajorCharacteristicController::class)->except(['create']);
