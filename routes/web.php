<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SearchController;
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

require __DIR__ . '/auth.php';
Route::get('/', function () {
    return view('welcome');
});

Route::get('/service/login', function () {
    return view('login');
})->name('service.login');

Route::get('/service/register', [AccountController::class, 'show'])->name('account.register');
Route::post('/service/register/check', [AccountController::class, 'confirm'])->name('register.check');
Route::get('/service/register/check', [AccountController::class, 'create'])->name('register.create');
Route::post('/service', [AccountController::class, 'store'])->name('register.store');

Route::post('/service/confirm', [LoginController::class, 'confirm'])->name('login.check');
Route::post('/service/login', [LogoutController::class, 'logout'])->name('go.login');

Route::get('/service', [LoginController::class, 'show'])->name('service.top');

Route::get('/service/search', [SearchController::class, 'search'])->name('service.search');

Route::middleware('auth')->group(function () {
    Route::get('/service/reservation/new', [ReservationController::class, 'createView'])->name('reservation.form');
    Route::post('/service/reservation/new', [ReservationController::class, 'confirm'])->name('reservation.confirm');
    Route::get('/service/reservation/list', [ReservationController::class, 'listView'])->name('service.view');
    Route::post('/service/reservation/list', [ReservationController::class, 'store'])->name('reservation.store');
    Route::get('/service/reservation/edit', [ReservationController::class, 'createModifyView'])->name('reservation.modifyForm');
    Route::post('/service/reservation/edit', [ReservationController::class, 'modifyConfirm'])->name('reservation.modifyConfirm');
    Route::put('/service/reservation/list', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::delete('/service/reservation/list', [ReservationController::class, 'delete'])->name('reservation.delete');
});

/*
|--------------------------------------------------------------------------
| JSON Routes
|--------------------------------------------------------------------------

 */
// 都道府県コードにマッチする市区町村を返すAPI
Route::get('/api/cities', [SearchController::class, 'searchCities'])->name('search.cities');
