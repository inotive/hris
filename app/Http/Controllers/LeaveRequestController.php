<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\LeaveRequest;
use App\Models\Post;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeaveRequestController extends Controller
{
    use CrudTrait;

    public $model = LeaveRequest::class;
    public $route = 'leave-requests';
    public $page_title = 'Leave Requests';
    public $action_title = 'Leave Request';

    public function store(Request $request)
    {

    
        $validate = (new $this->model)->rules;
        $validated = $request->validate($validate);


        $create = $request->all();
        unset($create['files']);
        $id = $this->model::create($create)->id;

        // upload file
        $files = $request->all()['files'] ?? [];

        foreach($files as $key => $value) {
            $row = json_decode($value);

    
            File::create([
                'company_id'    => $request->company_id,
                'module'    => 'leave',
                'name'  => $row->file,
                'file'  => $row->file,
                'url'   => $row->url,
                'extension' => 'test',
                'size'   => 1,
                'employee_id'   => $request->employee_id,
                'module_id' => $id,
            ]);
        }

        session()->flash('messages', [
            'success'   =>  __($this->created_message ?? 'Data Saved Successfully')
        ]);

        $redirect = session()->get('redirect') ?? null;

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => $redirect ?? route($this->route . '.index'),
        ];
    }

    public function edit($id, Request $request)
    {
        $r =  $this->route;
        $r = str_replace("-","_", $r);


        if ($request->redirect != null) {
            session()->flash('redirect', $request->redirect);
        } 

        $form = $this->model::find($id);
        return view('crud.edit', [
            'view'  => $r . '.form',
            'form'  => $form,
            'page_title'    => __('Edit') . ' ' . ($this->action_title ?? $this->page_title ?? ''),
        ]);
    }
}
