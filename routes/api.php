<?php


use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\EmployeeContractController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeEducationController;
use App\Http\Controllers\Api\EmployeeEmergencyContactController;
use App\Http\Controllers\Api\EmployeeFamilyInfoController;
use App\Http\Controllers\Api\EmployeeOrganizationController;
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


    Route::get('/attendance-summary', [AttendanceController::class ,'summary']);
});