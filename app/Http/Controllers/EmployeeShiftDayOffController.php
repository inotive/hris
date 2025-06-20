<?php

namespace App\Http\Controllers;

use App\Models\EmployeeShift;
use App\Models\EmployeeShiftDayOff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeShiftDayOffController extends Controller
{
    public function index(Request $request)
    {
        $company_id = $request->company_id ?? $request->filter['company_id'] ?? null;

        $search = $request->search ?? null;
        

        $year = $request->year ?? date('Y');
        $list = EmployeeShiftDayOff::whereYear('date', $year)
            ->when($company_id != null, function ($query) use ($company_id) {
                $query->where('company_id', $company_id);
            })

            ->orderBy('date', 'asc')
            ->paginate();
        return view('employee_shift_day_off.index', [
            'list'  => $list,
        ]);
    }

    public function create(Request $request)
    {
        return view('employee_shift_day_off.create', []);
    }

    public function edit($id, Request $request)
    {
        return view('employee_shift_day_off.edit', [

            'form'  => EmployeeShiftDayOff::find($id),
        ]);
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            Log::info($request->dayoff);
            
            foreach ($request->dayoff as $key => $value) {
                $first = EmployeeShiftDayOff::firstOrCreate([
                    'company_id'    => $request->company_id,
                    'shift_id'  => $value['shift_id'],
                    'date'  => $value['date'],
                ]);

                if ($first) {
                    $first->description = $value['desc'];
                    $first->save();
                }
            }

            $message = __('Data Saved Successfully');
            session()->flash('messages', [
                'success'   =>  $message,
            ]);

            DB::commit();

            return [
                'success'   => true,
                'message'   => $message,
                'redirect'  => route('employee-shifts-day-off.index'),
            ];
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return [
                'success'   => false,
                'message'   => 'Error',
            ];
        }
    }


    public function destroy($id, Request $request)
    {
        try{

            EmployeeShiftDayOff::where('id', $id)->delete();
        
            return [
                'success'   => true,
                'meessage'  => 'Deleted',
            ];
        }catch(Exception $e) {

            return [
                'success'   => false,
                'meessage'  => 'Error',
            ];
        }
    }
}
