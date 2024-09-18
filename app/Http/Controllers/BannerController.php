<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use CrudTrait;

    public $model = Banner::class;
    public $route = 'banners';
    public $page_title = 'Banners';
}
