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
            'view' => 'users.change-password',
            'form' => $form,
            'action' => $action,
            'back_route' => $back_route,
            'page_title' => __('Change Password'),
        ]);
    }

    // untuk update password
    private function _changePassUpdate($id, Request $request, $redirect = null)
    {
        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $data = [
            'password' => bcrypt($request->password),
        ];
        if ($id == auth()->user()->id) {
            $data['password_updated_at'] = now();
        }
        $this->model::where('id', $id)->update($data);

        session()->flash('messages', [
            'success' => __('Password Updated Successfully')
        ]);





        return [
            'success' => true,
            'message' => __('Password Updated Successfully'),
            'redirect' => $redirect,
        ];
    }

    // users master
    public function changePassword($id, Request $request)
    {
        $action = route('users.change-password.update', $id);
        return $this->_changePass($id, $request, $action, null);

    }


    public function changePasswordUpdate($id, Request $request)
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
        return $this->_changePassUpdate(auth()->user()->id, $request, route('dashboard'));
    }

    public function profile()
    {
        $form = auth()->user();
        return view('crud.edit', [
            'view' => 'users.profile',
            'form' => $form,
            'action' => route('user.profile.update'),
            'page_title' => __('Edit Profile'),
            'back_route' => route('dashboard'),
        ]);
    }

    public function profileUpdate(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|unique:users,phone,' . $user->id,
            'image' => '',
        ]);

        $user->update($validated);

        session()->flash('messages', [
            'success' => __('Profile Updated Successfully')
        ]);

        return [
            'success' => true,
            'message' => __('Profile Updated Successfully'),
            'redirect' => route('user.profile'),
        ];
    }
}
