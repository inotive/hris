<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\CompanySubscription;
use App\Models\CompanySubscriptionPerCompany;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class CompanySubscriptionDetailController extends Controller
{
    use CrudTrait;

    public $model = CompanySubscriptionPerCompany::class;
    public $route = 'company-subscriptions-detail';
    public $page_title = 'Company Subscriptions';
    public $action_title = 'Company Subscription';
}
