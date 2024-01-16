<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\owner\rentalsController;
use App\Http\Controllers\owner\CarsController;
use App\Http\Controllers\user\DashboardUserController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\OwnerRole;
use App\Http\Middleware\UserRole;
use Illuminate\Support\Facades\Route;

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

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('do-login', [AuthController::class, 'login'])->name('do-login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'showRegisterPage'])->name('register');
Route::post('do-register', [AuthController::class, 'registerUser'])->name('do-register');

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');

    /// Owner
    Route::middleware([OwnerRole::class])->prefix('owner')->group(function () {
        Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('owner.dashboard');
        Route::get('cars', [CarsController::class, 'index'])->name('owner.cars');
        Route::get('rentals', [rentalsController::class, 'index'])->name('owner.rentals');
        Route::post('add-car', [CarsController::class, 'store'])->name('owner.add-car');
        Route::post('update-car', [CarsController::class, 'update'])->name('owner.update-car');
        Route::post('delete-car', [CarsController::class, 'destroy'])->name('owner.delete-car');
    });

    /// User
    Route::middleware([UserRole::class])->group(function () {
        Route::get('dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');
    });
});
