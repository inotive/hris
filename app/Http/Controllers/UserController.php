<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use CrudTrait;

    public $model = User::class;
    public $route = 'users';

    public $created_message = "User created. Password send to email";
    public $page_title = "Management User";
    public $action_title = "User";


    // untuk view change password
    private function _changePass($id, Request $request, $action = null, $back_route = null)
    {
        $form = $this->model::find($id);
        return view('crud.edit', [
            'view'  => 'users.change-password',
            'form'  => $form,
            'action'=> $action,
            'back_route'    => $back_route,
            'page_title'    => __('Change Password'),
        ]);
    }

    // untuk update password
    private function _changePassUpdate($id, Request $request, $redirect= null)
    {
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'password'  => bcrypt($request->password),
        ];
        if ($id == auth()->user()->id) {
            $data['password_updated_at'] = now();
        }
        $this->model::where('id', $id)->update($data);

        session()->flash('messages', [
            'success'   => __('Password Updated Successfully')
        ]);





        return [
            'success'   => true,
            'message'   => __('Password Updated Successfully'),
            'redirect'  => $redirect,
        ];
    }

    // users master
    public function changePassword($id, Request $request)
    {
        $action = route('users.change-password.update', $id);
        return $this->_changePass($id, $request, $action, null);
        
    }


    public function changePasswordUpdate( $id, Request $request)
    {
        $redirect = route($this->route . '.index');
        return $this->_changePassUpdate($id, $request, $redirect);
       
    }


    // user profile
    public function changePasswordMe(Request $request)
    {
        $action = route('user.change-password.update', auth()->user()->id);
        return $this->_changePass(auth()->user()->id, $request, $action, route('dashboard'));
    }

    public function changePasswordMeUpdate($id, Request $request)
    {
        return $this->_changePassUpdate(auth()->user()->id, $request, route('user.change-password'));
    }
}
