<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class EmployeeController extends Controller
{
    public function profile(Request $request)
    {
        $auth = auth()->user();

        if ($auth != null && $auth instanceof Employee) {
            return [
                'status'    => 'success',
                'data'  => new EmployeeResource($auth),
            ];
        } else {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Unauthorized',
            ], 401);
        }
    }

    public function updateProfile(Request $request)
    {
        $auth = auth()->user();

        Log::info($request->all());

        Employee::where('id', $auth->id)->update($request->all());

        return [
            'status'    => 'success',
            'message'   => 'Personal info update successful',
        ];
    }

    public function login(Request $request)
    {
        try{
            $username = $request->username;
            $password = $request->password;
            
            // $fcm_token = $request->fcm_token;


            $user = Employee::where('username', $username)
                ->orderBy('id','desc');


            if ($user->count() == 0) {
                throw new Exception('User Not Found', 401);
            } 

            $user = $user->first();
            if ($user->status == 0) {
                throw new Exception('User Not Active', 401);
            }


            if (auth()->guard('employee')->attempt(['username' => $username, 'password' => $password])) {


                $token = $user->getToken();
                return [
                    'status'    => 'success',
                    'message'   => 'Login successful',
                    'data'  =>  [
                        'token' => $token,
                        'user'  => new EmployeeResource($user),
                    ]
                ];

            } else {
               throw new Exception('Invalid username or password', 401);
            }

        } catch(Exception $e){
            Log::error($e);
            if (is_int($e->getCode())) {
                return response()->json([
                    'status'    => 'error',
                    'message'   => $e->getMessage(),
                ], 401);
            } else {
                return response()->json([
                    'status'    => 'error',
                    'message'   => 'Error',
                ], 500);
            }
           
        }
        
    }

    public function logout(Request $request)
    {
        $auth = auth()->user();


        if ($auth != null && $auth instanceof Employee) {
            $auth->logout();
            return response()->json([
                'status'    => 'error',
                'message'   => 'Logout successful',
            ], 200);
        } else {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Token not provided or invalid',
            ], 401);
        }
    }
}
