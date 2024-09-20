<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Banner;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class AttendanceContrller extends Controller
{
    use CrudTrait;

    public $model = Attendance::class;
    public $route = 'attendances';
    public $page_title = 'Attendances';
    public $action_title = 'Attendance';
}
