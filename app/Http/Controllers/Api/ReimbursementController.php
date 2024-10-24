<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReimbursementRequestResource;
use App\Models\File;
use App\Models\ReimbursementExpense;
use App\Models\ReimbursementExpenseList;
use App\Models\ReimbursementRequest;
use App\Models\ReimbursementType;
use App\Services\Base64FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReimbursementController extends Controller
{
    public function index(Request $request)
    {
        $auth = auth()->user();

        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $list = ReimbursementRequest::query()
            ->when($status != null, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($start_date != null, function ($query) use ($start_date) {
                $query->whereDate('created_at', '>=', $start_date);
            })
            ->when($end_date != null, function ($query) use ($end_date) {
                $query->whereDate('created_at', '<=', $end_date);
            })
            ->when($request->month != null, function ($query) use ($request) {
                return $query->whereMonth('created_at', $request->month);
            })
            ->when($request->year != null, function ($query) use ($request) {
                return $query->whereYear('created_at', $request->year);
            })
            ->orderBy('created_at', $request->sort ?? 'desc')
            ->paginate();

        $pagination = $list->toArray();
        unset($pagination['data']);

        return [
            'success'   => true,
            'data'  => ReimbursementRequestResource::collection($list),
            'pagination'    => $pagination,
        ];
    }


    public function detail($id, Request $request)
    {

        $data = ReimbursementRequest::where('id', $id)

            ->first();

        return [
            'success'   => true,
            'data'  => new ReimbursementRequestResource($data),
        ];
    }


    public function create(Request $request)
    {
        $auth = auth()->user();

        $request->merge([
            'employee_id'   => $auth->id,
            'company_id'   => $auth->company_id,
            'manager_id'    => $auth->head_department_id,
            'status'    => 'pending',
            'total' => 0,
        ]);





        $validate = (new ReimbursementRequest())->rules;
        $validated = $request->validate($validate);

        $reimbursement = ReimbursementRequest::create($validated);

        $expenses = $request->expenses ?? [];


        $total = 0;
        foreach ($expenses as $key => $value) {
            // $row = json_decode($value);

            $expense = ReimbursementExpense::find($value['expenses_id']);

            ReimbursementExpenseList::create([
                'reimbursement_request_id'      => $reimbursement->id,
                'reimbursement_expense_id' => $value['expenses_id'],
                'value' => $value['value'],
                'name' => $expense->name ?? null,
                'company_id'    => $auth->company_id,
                'employee_id'   => $auth->id,
            ]);

            $total += $value['value'] ?? 0;
        }

        $reimbursement->total = ReimbursementExpenseList::where('reimbursement_request_id', $reimbursement->id)->sum('value');


        return [
            'status'    => 'success',
            'message'   => "Reimbursement request data create successful"
        ];
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $auth = auth()->user();


        $request->merge([
            'employee_id'   => $auth->id,
            'company_id'   => $auth->company_id,
            'manager_id'    => $auth->head_department_id,
            'status'    => 'pending',
            'total' => 0,
        ]);





        $validate = (new ReimbursementRequest())->rules;
        $validated = $request->validate($validate);

        $reimbursement = ReimbursementRequest::where('id', $id)->first();
        $reimbursement->fill($request->all());
        $reimbursement->save();

        $expenses = $request->expenses ?? [];


        $total = 0;
        ReimbursementExpenseList::where('reimbursement_request_id', $reimbursement->id)->delete();
        foreach ($expenses as $key => $value) {
            // $row = json_decode($value);

            $expense = ReimbursementExpense::find($value['expenses_id']);

            ReimbursementExpenseList::create([
                'reimbursement_request_id'      => $reimbursement->id,
                'reimbursement_expense_id' => $value['expenses_id'],
                'value' => $value['value'],
                'name' => $expense->name ?? null,
                'company_id'    => $auth->company_id,
                'employee_id'   => $auth->id,
            ]);

            $total += $value['value'] ?? 0;
        }

        $reimbursement->total = ReimbursementExpenseList::where('reimbursement_request_id', $reimbursement->id)->sum('value');


        return [
            'status'    => 'success',
            'message'   => "Reimbursement Request data update successful"
        ];
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        ReimbursementExpenseList::where('reimbursement_request_id', $id)->delete();
        ReimbursementRequest::where('id', $id)->delete();
        return [
            'status'    => 'success',
            'message' => "Reimbursement Request data delete successful"
        ];
    }

    public function reimburesementType(Request $request)
    {
        $company_id = $request->company_id ?? auth()->user()->company_id;
        $list = ReimbursementType::where('company_id', $company_id)->orderBy('name')->pluck('name', 'id');

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

    public function expenseType(Request $request)
    {
        $company_id = $request->company_id ?? auth()->user()->company_id;
        $list = ReimbursementExpense::where('company_id', $company_id)
            ->orderBy('name')
            ->pluck('name', 'id');

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
