<?php

namespace App\Http\Controllers;

use App\Models\ReimbursementExpense;
use App\Models\ReimbursementExpenseList;
use App\Models\ReimbursementRequest;
use App\Models\ReimbursementRequestDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReimbursementRequestController extends Controller
{
    public function index( Request $request)
    {
        $list = ReimbursementRequest::search($request->search)->paginate();

        return view('reimbursement_requests.index',[
            'list'  => $list,

        ]);
    }


    public function create( Request $request)
    {
        return view('reimbursement_requests.create',[

        ]);
    }

    public function edit( $id, Request $request)
    {
        $form = ReimbursementRequest::find($id);

        // dd($form);

        return view('reimbursement_requests.edit',[

            'form'  => $form,
        ]);
    }

    private function _save(Request $request)
    {
        try{

            $total = 0;

            $expenses = $request->expenses ?? [];


            foreach($expenses as $k => $v) {
                $total += (float) $v['amount'];
            }

            DB::beginTransaction();

            $form = $request->request_id != null ? ReimbursementRequest::where('id', $request->request_id)->first() : new ReimbursementRequest();
            $form->company_id = $request->company_id;
            $form->employee_id = $request->employee_id;
            $form->date = $request->date;
            $form->reimbursement_type_id = $request->reimbursement_type_id;
            $form->manager_id = $request->manager_id;
            $form->total = $total;


            $form->save();

            // Log::info($form);
            // Log::info(json_encode($request->all()));
            // return null;
            

            ReimbursementExpenseList::where('reimbursement_request_id', $form->id)->delete();

            foreach($expenses as $k => $v) {
                $name = ReimbursementExpense::where('id', $v['type'])->first()->name ?? null;
                ReimbursementExpenseList::create([
                    'employee_id'    => $request->employee_id,
                    'company_id'    => $request->company_id,
                    'reimbursement_request_id'    => $form->id,
                    'reimbursement_expense_id'    => $v['type'],
                    'name'  => $name ?? '-',
                    'value' => (float) $v['amount'],
                ]);
            }


            DB::commit();
            return [
                'success'   => true,
                'message'   => __('Data Saved Successfully'),
                'redirect'  => route('reimbursement-requests.index'),
            ];


        }catch(Exception $e){
            Log::error($e);
            DB::rollBack();
            return [
                'success'   => false,
                'message'   => __('Error'),
            ];
        }
    }

    public function store( Request $request)
    {
       return $this->_save($request);
    }


    public function update( $id, Request $request)
    {
        return $this->_save($request);
    }


    public function destroy( $id, Request $request)
    {
        try{

            ReimbursementRequest::where('id', $id)->delete();
        
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
