<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\View\Components\CurrencyDropdown;
use App\View\Components\PeriodDropdown;
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


        $employee = Employee::where('id', $auth->id)->first();
        
        
        $employee->fill($request->all());
        $employee->save();

        return [
            'status'    => 'success',
            'message'   => 'Personal info update successful',
        ];
    }


    public function updatePassword(Request $request)
    {
        $auth = auth()->user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|same:re_new_password',
            're_new_password' => 'required',
        ]);

        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $re_new_password = $request->re_new_password;

        if (auth()->guard('employee')->attempt(['username' => $auth->username, 'password' => $old_password])) {

            Employee::where('id', $auth->id)->update([
                'password'  =>bcrypt($new_password),
            ]);

            return [
                'status'    => 'success',
                'message'   => 'New password update successful',
            ];
        } else {
            return [
                "status"=> "error",
                "message"=> "Wrong Old Password",
            ];
        }

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

    public function gender()
    {
        $list = Employee::genderDropdown();

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status'    => 'success',
            'data'      => $data,
        ];
    }

    public function religion()
    {
        $list = Employee::religionDropdown();

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status'    => 'success',
            'data'      => $data,
        ];
    }

    public function maritalStatus()
    {
        $list = Employee::maritalStatusDropdown();

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status'    => 'success',
            'data'      => $data,
        ];
    }


    public function period()
    {
        $list = PeriodDropdown::dropdown();

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status'    => 'success',
            'data'      => $data,
        ];
    }


    public function currency()
    {
        $list = CurrencyDropdown::dropdown();

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status'    => 'success',
            'data'      => $data,
        ];
    }
}
