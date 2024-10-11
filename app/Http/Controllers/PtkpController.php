<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Ptkp;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class PtkpController extends Controller
{
    use CrudTrait;

    public $model = Ptkp::class;
    public $route = 'ptkp';
    public $page_title = 'PTKP';
    public $action_title = 'PTKP';
}
