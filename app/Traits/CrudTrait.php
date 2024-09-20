<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait CrudTrait 
{


    public function index(Request $request)
    {
        $show_dummy_button = false;
        $rows_count = $this->model::count();
        if ($rows_count == 0 && method_exists($this->model,'dummy_data') && count($this->model::dummy_data() ?? []) > 0)
        {
            $show_dummy_button = true;
        }

        if ($request->generate_dummy == 1) {
         
            if ($rows_count == 0) {
                // can generate if zero data
                $inserts = $this->model::dummy_data() ?? [];
                if (count($inserts) > 0) {
                    foreach($inserts as $key => $value) {
                        $this->model::create($value);
                    }  
                    
                    session()->flash('messages', [
                        'success'   =>  __('Generate Dummy Successfully')
                    ]);
                }


                return redirect()->route($this->route . '.index');
            
            }
        }
        $r =  $this->route;
        $r = str_replace("-","_", $r);

        $filter = $request->filter;


        $search = $request->search;
        $list = $this->model::search($search)
            ->filter($filter)
            ->paginate();


        $add_button_href = $this->addButtonHref();

        return view( ($this->view_folder ?? $r) . '.index',[
            'list'  => $list,
            'page_title'    => $this->page_title,
            'action_title'    => $this->action_title ?? $this->page_title,
            'show_dummy_button'    => $show_dummy_button,
            'add_button_href'  => $add_button_href ?? null,
        ]);
    }

    public function create(Request $request)
    {
        $r =  $this->route;
        $r = str_replace("-","_", $r);


        if ($request->redirect != null) {
            session()->flash('redirect', $request->redirect);
        } 


        return view('crud.create',[
            'page_title'    => __('Add') . ' ' . ($this->action_title ?? $this->page_title ?? ''),
            'view'  => $r . '.form',
            'form'  => null,
        ]);
    }


    public function store(Request $request)
    {
        $validate = (new $this->model)->rules;
        $validated = $request->validate($validate);
        $this->model::create($validated);

        session()->flash('messages', [
            'success'   =>  __($this->created_message ?? 'Data Saved Successfully')
        ]);

        // return redirect()->route($this->route . '.index');

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

    public function update( $id, Request $request)
    {
        $r =  $this->route;
        $r = str_replace("_","-", $r);
        
        $validate = (new $this->model)->rules;
        $validated = $request->validate($validate);

        // Log::info($request->all());

        $this->model::where('id', $id)->update($validated);

        session()->flash('messages', [
            'success'   => __('Data Saved Successfully')
        ]);

        // return redirect()->route($this->route . '.index');

        $redirect = session()->get('redirect') ?? null;

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => $redirect ?? route($this->route . '.index'),
        ];
    }

    public function destroy($id)
    {
        try{

            $this->model::where('id', $id)->delete();
        
            return [
                'success'   => true,
                'message'  => 'Deleted',
            ];
        }catch(Exception $e) {
            Log::error($e);
            $message = $e->errorInfo[2] ?? 'Error';
            return [
                'success'   => false,
                'error' => $e,
                'message'  => $message,
            ];
        }
    }

    // change create button link
    public function addButtonHref()
    {
        return null;
    }
}