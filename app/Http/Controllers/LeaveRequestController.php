<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Post;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    use CrudTrait;

    public $model = LeaveRequest::class;
    public $route = 'leave-requests';
    public $page_title = 'Leave Requests';
    public $action_title = 'Leave Request';

}
