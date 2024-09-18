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
}
