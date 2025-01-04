<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Company;
use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\OvertimeRequest;
use App\Models\ReimbursementRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:superadmin,admin,finance,content');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $auth = auth()->user();

        if ($auth->role == 'superadmin'){
            return $this->indexSuperadmin($request);
        }else if ($auth->role == 'admin') {
            return view('dashboard.dashboard');
        }
        return view('dashboard.dashboard');
    }


    private function indexSuperadmin(Request $request)
    {
        $total_company = Company::count();
        $total_employee = Employee::count();
        $total_attendance = Attendance::count();
        $total_leave = LeaveRequest::count();
        $total_overtime = OvertimeRequest::count();
        $total_reimbursement = ReimbursementRequest::count();

        $top_companies = Company::when(request()->search_company != null, function($query){
            $query->where('name', 'like', '%' . request()->search_company . '%');
        })
        ->get();

        return view('dashboard.dashboard-superadmin',[
            'total_company'    => $total_company,
            'total_employee'    => $total_employee,
            'total_attendance'    => $total_attendance,
            'total_leave'    => $total_leave,
            'total_overtime'    => $total_overtime,
            'total_reimbursement'    => $total_reimbursement,


            'top_companies' => $top_companies,
        ]);
    }
}
