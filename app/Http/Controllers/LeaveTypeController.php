<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Models\Post;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    use CrudTrait;

    public $model = LeaveType::class;
    public $route = 'leave-types';
    public $page_title = 'Leave Types';
    public $action_title = 'Type';

}
