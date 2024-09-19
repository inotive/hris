<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Banner;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    use CrudTrait;

    public $model = Announcement::class;
    public $route = 'announcements';
    public $page_title = 'Announcements';
    public $action_title = 'Announcement';
}
