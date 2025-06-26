<?php

namespace App\Http\Controllers;

use App\Models\File;
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

        $company_id = $request->filter['company_id'] ?? null;


        $daterange = $request->filter['daterange'] ?? null;

        
        
        $list = ReimbursementRequest::search($request->search)
            ->when($company_id, function($query) use($company_id){
                $query->where('company_id', $company_id);
            })
            ->when($daterange, function($query) use($daterange){
                $query->whereBetween('date', explode(' - ', $daterange));
            })
            ->orderBy('created_at', 'desc')
            ->paginate();

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

        $files = File::reimbursement($id)->get()->map(function($row){
            return [
                'file'  => $row->file,
                'url'  => $row->url,
                'file_id'    => $row->id,
            ];
        });

        return view('reimbursement_requests.edit',[

            'form'  => $form,
            'files' => $files,
        ]);
    }

    private function _save(Request $request)
    {

        $validate = (new ReimbursementRequest())->rules;
        $validated = $request->validate($validate);

        try{

            $total = 0;

            $expenses = $request->expenses ?? [];

            if (count($expenses) == 0) {
                return [
                    'success'   => false,
                    'message'   => __('Expenses is required'),
                ];
            }

            $files = $request->all()['files'] ?? [];


            if (count($files) == 0) {
                return [
                    'success'   => false,
                    'message'   => __('Files is required'),
                ];
            }


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

            // upload file
            File::reimbursement($form->id)->delete();
         

            foreach($files as $key => $value) {
                $row = json_decode($value);

        
                File::create([
                    'company_id'    => $request->company_id,
                    'module'    => 'reimburse',
                    'name'  => $row->file,
                    'file'  => $row->file,
                    'url'   => $row->url,
                    'extension' => 'test',
                    'size'   => 1,
                    'employee_id'   => $request->employee_id,
                    'module_id' => $form->id,
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
                'error' => $e->getMessage(),
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
                'message'  => 'Deleted',
            ];
        }catch(Exception $e) {

            return [
                'success'   => false,
                'message'  => 'Error',
                'error' => $e->getMessage(),
            ];
        }
    }
}
