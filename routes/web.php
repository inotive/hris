<?php

use App\Http\Controllers\ChangeLanguageController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDepartmentController;
use App\Http\Controllers\EmployeeLevelController;
use App\Http\Controllers\EmployeePositionController;
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
    return redirect()->route('dashboard');
});


Auth::routes();
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::post('/upload', [UploadController::class, 'uploadImage'])->name('upload');

    
    Route::resource('/users', UserController::class);
    Route::resource('/companies', CompanyController::class);
    Route::resource('/employees', EmployeeController::class);
    Route::resource('/employee-departments', EmployeeDepartmentController::class);
    Route::resource('/employee-positions', EmployeePositionController::class);
    Route::resource('/employee-levels', EmployeeLevelController::class);

    Route::get('/change-language/{locale}', [ChangeLanguageController::class, 'changeLang'])->name('change-language');


});