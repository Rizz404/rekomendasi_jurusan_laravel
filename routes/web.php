<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollegeMajorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MajorCharacteristicController;
use App\Http\Controllers\MyCollegeMajorController;
use App\Http\Controllers\MyGradeController;
use App\Http\Controllers\MyRecomendationController;
use App\Http\Controllers\MyUniversityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SawResultController;
use App\Http\Controllers\StudentScoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// * Ada contoh dan penjelasan di learn/web.php buat belajar

// * Base route
Route::get('/', [LandingController::class, 'index'])->name('landing');

// * Auth
Route::middleware('guest')->group(function ()
{
    // * Default routenya login dan register gak usah diganti-ganti
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// * User route
Route::middleware(['auth', 'role:user'])->group(function ()
{
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::prefix('profile')->name('profile.')->group(function ()
    {
        Route::get('/index', [ProfileController::class, 'index'])->name('index');
        Route::patch('/upsert', [ProfileController::class, 'upsert'])->name('upsert');
    });

    Route::prefix('my-college-majors')->name('my-college-majors.')->group(function ()
    {
        Route::get('/', [MyCollegeMajorController::class, 'index'])->name('index');
        Route::get('/{collegeMajor}', [MyCollegeMajorController::class, 'show'])->name('show');
    });

    Route::prefix('my-universities')->name('my-universities.')->group(function ()
    {
        Route::get('/', [MyUniversityController::class, 'index'])->name('index');
        Route::get('/{university}', [MyUniversityController::class, 'show'])->name('show');
    });

    Route::prefix('my-grades')->name('my-grades.')->group(function ()
    {
        Route::get('/create-many', [MyGradeController::class, 'createMany'])->name('create-many');
        Route::post('/store-many', [MyGradeController::class, 'storeMany'])->name('store-many');
        Route::post('/destroy-many', [MyGradeController::class, 'destroyMany'])->name('destroy-many');
    });
    Route::resource('my-grades', MyGradeController::class)->parameters([
        'my-grades' => 'studentScore'
    ]);

    Route::prefix('my-recommendations')->name('my-recommendations.')->group(function ()
    {
        Route::get('/', [MyRecomendationController::class, 'index'])->name('index');
        Route::post('/calculate/{student}', [MyRecomendationController::class, 'calculate'])->name('calculate');
        Route::post('/recalculate/{student}', [MyRecomendationController::class, 'recalculate'])->name('recalculate');
    });
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function ()
{
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // * User gak ada create many karena harus presisi
    Route::prefix('users')->name('users.')->group(function ()
    {
        Route::post('/destroy-many', [UserController::class, 'destroyMany'])->name('destroy-many');
    });
    Route::resource('users', UserController::class);

    Route::get('/criterias/search', [CriteriaController::class, 'search'])->name('criterias.search');
    Route::resource('criterias', CriteriaController::class);

    Route::resource('college-majors', CollegeMajorController::class);

    Route::prefix('major-characteristics')->name('major-characteristics.')->group(function ()
    {
        // Route::get('/create-many', [MajorCharacteristicController::class, 'createMany'])->name('create-many');
        // Route::post('/store-many', [MajorCharacteristicController::class, 'storeMany'])->name('store-many');
        Route::post('/destroy-many', [MajorCharacteristicController::class, 'destroyMany'])->name('destroy-many');
    });
    Route::get('/major-characteristics/create/{collegeMajor?}', [MajorCharacteristicController::class, 'create'])
        ->name('major-characteristics.create');
    Route::resource('major-characteristics', MajorCharacteristicController::class)->except(['create']);

    Route::prefix('student-scores')->name('student-scores.')->group(function ()
    {
        // Route::get('/create-many', [StudentScoreController::class, 'createMany'])->name('create-many');
        // Route::post('/store-many', [StudentScoreController::class, 'storeMany'])->name('store-many');
        Route::post('/destroy-many', [StudentScoreController::class, 'destroyMany'])->name('destroy-many');
    });
    Route::resource('student-scores', StudentScoreController::class);
});
