<?php


use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\CurrencyController;
use App\Http\Controllers\Api\EmployeeContractController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeEducationController;
use App\Http\Controllers\Api\EmployeeEmergencyContactController;
use App\Http\Controllers\Api\EmployeeFamilyInfoController;
use App\Http\Controllers\Api\EmployeeOrganizationController;
use App\Http\Controllers\Api\LeaveRequestController;
use App\Http\Controllers\Api\LeaveTypeController;
use App\Http\Controllers\Api\OvertimeRequestController;
use App\Http\Controllers\Api\OvertimeTypeController;
use App\Http\Controllers\Api\PeriodController;
use App\Http\Controllers\Api\ReimbursementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/login', [EmployeeController::class, 'login']);

Route::middleware([
    'auth:sanctum', 
])->group(function () {

    Route::get('/profile', [EmployeeController::class, 'profile']);
    Route::put('/profile', [EmployeeController::class, 'updateProfile']);
    Route::put('/change-password', [EmployeeController::class, 'updatePassword']);
    Route::apiResource('/profile/emergency-contact', EmployeeEmergencyContactController::class);
    Route::apiResource('/profile/family-info', EmployeeFamilyInfoController::class);
    Route::apiResource('/profile/education', EmployeeEducationController::class);
    Route::apiResource('/profile/contract', EmployeeContractController::class);
    Route::apiResource('/profile/organization', EmployeeOrganizationController::class);
    Route::post('/auth/logout', [EmployeeController::class, 'logout']);


    Route::get('/attendances', [AttendanceController::class,'index']);
    Route::get('/attendance', [AttendanceController::class,'detail']);
    Route::put('/attendance/clockin', [AttendanceController::class,'clockin']);
    Route::put('/attendance/clockout', [AttendanceController::class,'clockout']);
    Route::get('/attendance-summary', [AttendanceController::class ,'summary']);


    // Route::get('/master-leave-type',[LeaveTypeController::class, 'index']);
    Route::get('/leave-requests',[LeaveRequestController::class, 'index']);
    Route::get('/leave-request/{id}',[LeaveRequestController::class, 'detail']);
    Route::post('/leave-request',[LeaveRequestController::class, 'create']);
    Route::put('/leave-request',[LeaveRequestController::class, 'update']);
    Route::delete('/leave-request',[LeaveRequestController::class, 'delete']);


    // Route::get('/master-overtime-type',[OvertimeTypeController::class, 'index']);

    Route::get('/overtime-requests',[OvertimeRequestController::class, 'index']);
    Route::get('/overtime-request/{id}',[OvertimeRequestController::class, 'detail']);
    Route::post('/overtime-request',[OvertimeRequestController::class, 'create']);
    Route::put('/overtime-request',[OvertimeRequestController::class, 'update']);
    Route::delete('/overtime-request',[OvertimeRequestController::class, 'delete']);


    Route::get('/reimbursement-requests',[ReimbursementController::class, 'index']);
    Route::get('/reimbursement-request/{id}',[ReimbursementController::class, 'detail']);
    Route::post('/reimbursement-request',[ReimbursementController::class, 'create']);
    Route::put('/reimbursement-request',[ReimbursementController::class, 'update']);
    Route::delete('/reimbursement-request',[ReimbursementController::class, 'delete']);


    // MASTER
    Route::get('/master/gender', [EmployeeController::class, 'gender']);
    Route::get('/master/religion', [EmployeeController::class, 'religion']);
    Route::get('/master/marital-status', [EmployeeController::class, 'maritalStatus']);
    Route::get('/master/family-relation', [EmployeeFamilyInfoController::class, 'familyRelation']);
    Route::get('/master/education-level', [EmployeeEducationController::class, 'educationLevel']);
    Route::get('/master/currency', [EmployeeController::class, 'currency']);
    Route::get('/master/period', [EmployeeController::class, 'period']);
    Route::get('/master/reason-leaving', [LeaveRequestController::class, 'reasonLeaving']);
    Route::get('/master/leave-type', [LeaveRequestController::class, 'leaveType']);
    Route::get('/master/overtime-type', [OvertimeRequestController::class, 'overtimeType']);
    Route::get('/master/reimburesement-type', [ReimbursementController::class, 'reimburesementType']);
});