<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\CompanySubscription;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class CompanySubscriptionController extends Controller
{
    use CrudTrait;

    public $model = CompanySubscription::class;
    public $route = 'company-subscriptions';
    public $page_title = 'Company Subscriptions';
    public $action_title = '';
}
