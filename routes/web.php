<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Management\DashboardController as MgtDashboardController;
use App\Http\Controllers\Management\UserController as MgtUserController;
use App\Http\Controllers\Management\ProfileController as MgtProfileController;
use App\Http\Controllers\CounselingReportController;
use App\Http\Controllers\LandingPageController as LandingPageController;
use App\Http\Controllers\Management\ReportController;
use App\Http\Controllers\Management\MajorsController as MgtMajorController;
use App\Http\Controllers\Management\ClassesController as MgtClassController;
use App\Http\Controllers\Management\StudentsController as MgtStudentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [LandingPageController::class, 'index'])->name('index');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.process');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(Authenticate::class)->group(function () {
    Route::get('/dashboard-redirect', function() {
        return redirect()->route('mgt.dashboard');
    })->name('dashboard.index');

    Route::name('mgt.')->prefix('managements')->group(function() {
        Route::controller(MgtDashboardController::class)->prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('/', 'index')->name('index');
        });

        Route::controller(MgtUserController::class)->prefix('users')->name('user.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::put('/{id}/activate', 'activate')->name('activate');
            Route::put('/{id}/inactivate', 'inactivate')->name('inactivate');
            Route::delete('/{id}', 'remove')->name('remove');
        });
        
        Route::controller(MgtMajorController::class)->prefix('majors')->name('majors.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::put('/{id}/activate', 'activate')->name('activate');
            Route::put('/{id}/inactivate', 'inactivate')->name('inactivate');
            Route::delete('/{id}', 'remove')->name('remove');
        });

        Route::controller(MgtClassController::class)->prefix('classes')->name('classes.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store');
            Route::get('/create', 'create')->name('create');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::put('/{id}/activate', 'activate')->name('activate');
            Route::put('/{id}/inactivate', 'inactivate')->name('inactivate');
            Route::delete('/{id}', 'remove')->name('remove');
        });
        
        Route::controller(MgtStudentsController::class)->prefix('students')->name('students.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('update');
            Route::put('/{id}/activate', 'activate')->name('activate');
            Route::put('/{id}/inactivate', 'inactivate')->name('inactivate');
            Route::delete('/{id}', 'remove')->name('remove');
        });
        
        Route::controller(ReportController::class)->prefix('counseling/reports')->name('counseling.reports.')->group(function () {
        Route::get('/', 'index')->name('index'); 
        Route::post('/{id}/update', 'updateStatus')->name('updateStatus');
    });

        Route::controller(MgtProfileController::class)->prefix('profile')->name('profile.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');
        });
    });
    
    
});

Route::get('/students/jadwal-konseling/nis', [CounselingReportController::class, 'showNisForm'])->name('counseling.nis');
    Route::post('/students/jadwal-konseling/form', [CounselingReportController::class, 'processNis'])->name('counseling.process');
    Route::get('/students/jadwal-konseling/form/{nis}', [CounselingReportController::class, 'showForm'])->name('counseling.form');
    Route::post('/students/jadwal-konseling/submit', [CounselingReportController::class, 'submitForm'])->name('counseling.submit');

