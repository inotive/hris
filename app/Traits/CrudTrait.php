<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

trait CrudTrait 
{

    public function index(Request $request)
    {
        $r =  $this->route;
        $r = str_replace("-","_", $r);

        $search = $request->search;
        $list = $this->model::search($search)
            ->paginate();

        return view($r . '.index',[
            'list'  => $list,
            'page_title'    => $this->page_title,
        ]);
    }

    public function create(Request $request)
    {
        $r =  $this->route;
        $r = str_replace("-","_", $r);
        return view('crud.create',[
            'page_title'    => __('Add') . ' ' . $this->page_title,
            'view'  => $r . '.form',
        ]);
    }


    public function store(Request $request)
    {
        $validate = (new $this->model)->rules;
        $validated = $request->validate($validate);
        $this->model::create($validated);

        session()->flash('messages', [
            'success'   => __('Data Saved Successfully')
        ]);

        // return redirect()->route($this->route . '.index');

        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route($this->route . '.index'),
        ];
    }

    public function edit($id, Request $request)
    {
        $r =  $this->route;
        $r = str_replace("-","_", $r);

        $form = $this->model::find($id);
        return view('crud.edit', [
            'view'  => $r . '.form',
            'form'  => $form,
            'page_title'    => __('Add') . ' ' . $this->page_title,
        ]);
    }

    public function update( $id, Request $request)
    {
        $r =  $this->route;
        $r = str_replace("_","-", $r);
        
        $validate = (new $this->model)->rules;
        $validated = $request->validate($validate);

        $this->model::where('id', $id)->update($validated);

        session()->flash('messages', [
            'success'   => __('Data Saved Successfully')
        ]);

        // return redirect()->route($this->route . '.index');


        return [
            'success'   => true,
            'message'   => __('Data Saved Successfully'),
            'redirect'  => route($this->route . '.index'),
        ];
    }

    public function destroy($id)
    {
        try{

            $this->model::where('id', $id)->delete();
        
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