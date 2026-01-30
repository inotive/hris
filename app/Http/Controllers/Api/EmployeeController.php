<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Jobs\NewPasswordJob;
use App\Jobs\ResetPasswordJob;
use App\Models\Employee;
use App\View\Components\CurrencyDropdown;
use App\View\Components\NationalityDropdown;
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
                'status' => 'success',
                'data' => new EmployeeResource($auth),
            ];
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
    }

    public function updateProfile(Request $request)
    {
        $auth = auth()->user();


        $employee = Employee::where('id', $auth->id)->first();

        $values = $request->all();

        foreach ($values as $key => $value) {
            $employee->$key = $value;
        }


        $employee->save();

        return [
            'status' => 'success',
            'message' => 'Personal info update successful',
            'data' => $employee,
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
                'password' => bcrypt($new_password),
            ]);

            return [
                'status' => 'success',
                'message' => 'New password update successful',
            ];
        } else {
            return [
                "status" => "error",
                "message" => "Wrong Old Password",
            ];
        }
    }

    public function login(Request $request)
    {
        try {
            $username = $request->username;
            $password = $request->password;

            // $fcm_token = $request->fcm_token;


            $user = Employee::where('username', $username)
                ->orderBy('id', 'desc');


            if ($user->count() == 0) {
                throw new Exception('User Not Found', 401);
            }

            $user = $user->first();
            if ($user->status == 0) {
                throw new Exception('User Not Active', 401);
            }


            if (auth()->guard('employee')->attempt(['username' => $username, 'password' => $password])) {


                $token = $user->getToken();

                $user = Employee::getByUsername($username);
                return [
                    'status' => 'success',
                    'message' => 'Login successful',
                    'data' => [
                        'token' => $token,
                        // 'user'  => new EmployeeResource($user),
                        'user' => $user,
                    ]
                ];
            } else {
                throw new Exception('Invalid username or password', 401);
            }
        } catch (Exception $e) {
            Log::error($e);
            if (is_int($e->getCode())) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 401);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error',
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
                'status' => 'success',
                'message' => 'Logout successful',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Token not provided or invalid',
            ], 401);
        }
    }


    public function resetPassword(Request $request)
    {
        $email = $request->email;

        $new_pass = rand(100000, 999999);

        $employee = Employee::where('email', $email)->first();

        if ($employee == null) {
            return [
                'status' => 'error',
                'message' => 'Employee Not Found',
            ];
        }
        $employee->code_forget_password = ($new_pass);
        $employee->token_forget_password = null;
        $employee->save();

        ResetPasswordJob::dispatch($employee->email, $new_pass);


        return [
            'status' => 'success',
            'message' => 'Your 6-digit verification code has been sent to your email. Please check your inbox or spam folder and enter the code to proceed.',
        ];


    }


    public function confirmCodeResetPassword(Request $request)
    {
        try {
            $email = $request->email;
            $code = $request->code;

            // $fcm_token = $request->fcm_token;


            $user = Employee::where('email', $email)
                ->orderBy('id', 'desc');


            if ($user->count() == 0) {
                throw new Exception('User Not Found', 401);
            }

            $user = $user->first();
            if ($user->status == 0) {
                throw new Exception('User Not Active', 401);
            }


            if ($user->code_forget_password == $code) {

                $new_pass = rand(100000, 999999) . uniqid();

                $user->code_forget_password = null;
                $user->token_forget_password = ($new_pass);
                $user->save();

                return [
                    'status' => 'success',
                    'message' => 'Valid Code. Please create new password',
                    'token' => $new_pass,
                ];
            } else {
                throw new Exception('Invalid code', 401);
            }
        } catch (Exception $e) {
            Log::error($e);
            if (is_int($e->getCode())) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 401);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error',
                ], 500);
            }
        }
    }


    public function resetPasswordNew(Request $request)
    {
        try {
            $token = $request->token;
            $email = $request->email;
            $password = $request->password;
            $re_password = $request->re_password;

            // $fcm_token = $request->fcm_token;

            if ($password != $re_password) {
                throw new Exception('Password Not Match', 401);
            }


            $user = Employee::where('email', $email)
                ->orderBy('id', 'desc');


            if ($user->count() == 0) {
                throw new Exception('User Not Found', 401);
            }

            $user = $user->first();
            if ($user->status == 0) {
                throw new Exception('User Not Active', 401);
            }


            if ($user->token_forget_password == $token) {

                $user->code_forget_password = null;
                $user->token_forget_password = null;
                $user->password = bcrypt($password);
                $user->save();

                return [
                    'status' => 'success',
                    'message' => 'Your password has been successfully changed. You can now log in with your new password.',
                ];
            } else {
                throw new Exception('Invalid token', 401);
            }
        } catch (Exception $e) {
            Log::error($e);
            if (is_int($e->getCode())) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 401);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error',
                ], 500);
            }
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
            'status' => 'success',
            'data' => $data,
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
            'status' => 'success',
            'data' => $data,
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
            'status' => 'success',
            'data' => $data,
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
            'status' => 'success',
            'data' => $data,
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
            'status' => 'success',
            'data' => $data,
        ];
    }


    public function nationality()
    {
        $list = NationalityDropdown::dropdown();

        $data = [];
        foreach ($list as $key => $value) {
            $data[] = [
                'key' => $key,
                'value' => $value,
            ];
        }

        return [
            'status' => 'success',
            'data' => $data,
        ];
    }
}
