<?php

namespace App\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

trait CrudTrait 
{

    public function index(Request $request)
    {
        $search = $request->search;
        $list = $this->model::search($search)
            ->paginate();

        return view($this->route . '.index',[
            'list'  => $list,
        ]);
    }

    public function create(Request $request)
    {
        return view('crud.create',[
            'view'  => $this->route . '.form',
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
        $form = $this->model::find($id);
        return view('crud.edit', [
            'view'  => $this->route . '.form',
            'form'  => $form,
        ]);
    }

    public function update( $id, Request $request)
    {
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