<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AttendanceContrller;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ChangeLanguageController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyPayoutSettingController;
use App\Http\Controllers\CompanySubscriptionController;
use App\Http\Controllers\EmployeeContractController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDepartmentController;
use App\Http\Controllers\EmployeeEducationController;
use App\Http\Controllers\EmployeeEmergencyContactController;
use App\Http\Controllers\EmployeeFamilyInfoController;
use App\Http\Controllers\EmployeeLevelController;
use App\Http\Controllers\EmployeeOrganizationExperienceController;
use App\Http\Controllers\EmployeePayrollController;
use App\Http\Controllers\EmployeePayslipController;
use App\Http\Controllers\EmployeePayslipDetailController;
use App\Http\Controllers\EmployeePayslipMasterController;
use App\Http\Controllers\EmployeePositionController;
use App\Http\Controllers\EmployeeShiftController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\OvertimeRequestController;
use App\Http\Controllers\OvertimeShiftRequestController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PtkpController;
use App\Http\Controllers\ReimbursementExpenseController;
use App\Http\Controllers\ReimbursementRequestController;
use App\Http\Controllers\ReimbursementTypeController;
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

Route::post('/upload', [UploadController::class, 'uploadImage'])->name('upload');

Auth::routes();
Route::middleware([
    'auth', 
    'password.changed',
    'role'
])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

 

    
    Route::resource('/users', UserController::class)->middleware(['role:superadmin']);
    Route::get('/users/{id}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::put('/users/{id}/change-password', [UserController::class, 'changePasswordUpdate'])->name('users.change-password.update');

    Route::get('/user/change-password', [UserController::class, 'changePasswordMe'])->name('user.change-password');
    Route::put('/user/change-password/{id}', [UserController::class, 'changePasswordMeUpdate'])->name('user.change-password.update');

    Route::resource('/companies', CompanyController::class);
    Route::get('/companies/get/select2', [CompanyController::class, 'select2'])->name('companies.select2');
    Route::get('/companies/{company}/payout-setting/{year}', [CompanyPayoutSettingController::class, 'calendar'])->name('companies.payout-setting');
    Route::post('/companies/{company}/payout-setting/{year}', [CompanyPayoutSettingController::class, 'calendarUpdate'])->name('companies.payout-setting.update');
    
    Route::resource('/ptkp', PtkpController::class);

    // Route::resource('/company-payout-settings', CompanyPayoutSettingController::class);

    Route::resource('/employees', EmployeeController::class);
    Route::get('/employees/{employee}/payroll', [EmployeePayrollController::class, 'index'])->name('employees.payroll');
    Route::post('/employees/{employee}/payroll', [EmployeePayrollController::class, 'update'])->name('employees.payroll-update');
    Route::get('/employees/get/select2', [EmployeeController::class, 'select2'])->name('employees.select2');
    Route::post('/employees/check-username', [EmployeeController::class, 'checkUsername'])->name('employees.check-username');
    
    Route::put('/employees/reset-password/{id}',[ EmployeeController::class,'resetPassword'])->name('employee-reset-password');
    Route::resource('/employees/{employee}/emergency-contact', EmployeeEmergencyContactController::class);
    Route::resource('/employees/{employee}/family-info', EmployeeFamilyInfoController::class);
    Route::resource('/employees/{employee}/education', EmployeeEducationController::class);
    Route::resource('/employees/{employee}/contract', EmployeeContractController::class);
    Route::resource('/employees/{employee}/organization-experience', EmployeeOrganizationExperienceController::class);
    Route::get('/employee/export', [EmployeeController::class, 'export'])->name('employees.export');

    Route::resource('/employee-departments', EmployeeDepartmentController::class);
    Route::get('/employee-departments/get/select2', [EmployeeDepartmentController::class, 'select2'])->name('employee-departments.select2');
    Route::resource('/employee-positions', EmployeePositionController::class);
    Route::get('/employee-positions/get/select2', [EmployeePositionController::class, 'select2'])->name('employee-positions.select2');
    Route::resource('/employee-levels', EmployeeLevelController::class);
    Route::resource('/employee-shifts', EmployeeShiftController::class);
    

    Route::resource('/employee-payslip-masters', EmployeePayslipMasterController::class);
    // Route::resource('/employee-payslip-details', EmployeePayslipDetailController::class);
    Route::resource('/employee-payslips', EmployeePayslipController::class);

    Route::resource('/company-subscriptions', CompanySubscriptionController::class);

    Route::resource('/attendances', AttendanceContrller::class);
    Route::resource('/banners', BannerController::class);
    Route::resource('/posts', PostController::class);
    Route::resource('/announcements', AnnouncementController::class);


    Route::resource('/leave-types', LeaveTypeController::class);
    Route::resource('/leave-requests', LeaveRequestController::class);
    
    Route::resource('/overtime-requests', OvertimeRequestController::class);
    Route::resource('/overtime-shift-requests', OvertimeShiftRequestController::class);
  

    Route::resource('/reimbursement-types', ReimbursementTypeController::class);
    Route::resource('/reimbursement-expenses', ReimbursementExpenseController::class);
    Route::resource('/reimbursement-requests', ReimbursementRequestController::class);

    Route::get('/change-language/{locale}', [ChangeLanguageController::class, 'changeLang'])->name('change-language');


});