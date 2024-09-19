<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\ChangeLanguageController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyPayoutSettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDepartmentController;
use App\Http\Controllers\EmployeeEducationController;
use App\Http\Controllers\EmployeeEmergencyContactController;
use App\Http\Controllers\EmployeeFamilyInfoController;
use App\Http\Controllers\EmployeeLevelController;
use App\Http\Controllers\EmployeePayslipDetailController;
use App\Http\Controllers\EmployeePayslipMasterController;
use App\Http\Controllers\EmployeePositionController;
use App\Http\Controllers\EmployeeShiftController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Models\EmployeeEmergencyContact;
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
Route::middleware([
    'auth', 
    'password.changed'
])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::post('/upload', [UploadController::class, 'uploadImage'])->name('upload');

    
    Route::resource('/users', UserController::class);
    Route::get('/users/{id}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::put('/users/{id}/change-password', [UserController::class, 'changePasswordUpdate'])->name('users.change-password.update');

    Route::get('/user/change-password', [UserController::class, 'changePasswordMe'])->name('user.change-password');
    Route::put('/user/change-password/{id}', [UserController::class, 'changePasswordMeUpdate'])->name('user.change-password.update');

    Route::resource('/companies', CompanyController::class);
    Route::get('/companies/{company}/payout-setting/{year}', [CompanyPayoutSettingController::class, 'calendar'])->name('companies.payout-setting');
    Route::post('/companies/{company}/payout-setting/{year}', [CompanyPayoutSettingController::class, 'calendarUpdate'])->name('companies.payout-setting.update');
    // Route::resource('/company-payout-settings', CompanyPayoutSettingController::class);

    Route::resource('/employees', EmployeeController::class);
    Route::resource('/employees/{employee}/emergency-contact', EmployeeEmergencyContactController::class);
    Route::resource('/employees/{employee}/family-info', EmployeeFamilyInfoController::class);
    Route::resource('/employees/{employee}/education', EmployeeEducationController::class);

    Route::resource('/employee-departments', EmployeeDepartmentController::class);
    Route::resource('/employee-positions', EmployeePositionController::class);
    Route::resource('/employee-levels', EmployeeLevelController::class);
    Route::resource('/employee-shifts', EmployeeShiftController::class);
    

    Route::resource('/employee-payslip-masters', EmployeePayslipMasterController::class);
    Route::resource('/employee-payslip-details', EmployeePayslipDetailController::class);

    Route::resource('/banners', BannerController::class);
    Route::resource('/posts', PostController::class);

    Route::get('/change-language/{locale}', [ChangeLanguageController::class, 'changeLang'])->name('change-language');


});