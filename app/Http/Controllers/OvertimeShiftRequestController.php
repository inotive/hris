<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use App\Models\OvertimeShiftRequest;
use App\Models\Post;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class OvertimeShiftRequestController extends Controller
{
    use CrudTrait;

    public $model = OvertimeShiftRequest::class;
    public $route = 'overtime-shift-requests';
    public $page_title = 'Overtime Shift';
    public $action_title = '';

}
