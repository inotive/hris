<?php

use App\Http\Controllers\ChangeLanguageController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Auth::routes();
Route::middleware(['auth'])->group(function () {

    Route::post('/upload', [UploadController::class, 'uploadImage'])->name('upload');

    
    Route::resource('/users', UserController::class);
    Route::resource('/companies', CompanyController::class);
    Route::resource('/employees', EmployeeController::class);

    Route::get('/change-language/{locale}', [ChangeLanguageController::class, 'changeLang'])->name('change-language');


});