<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\CompanySubscriptionGroupCompany;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class CompanySubscriptionController extends Controller
{
    use CrudTrait;

    public $model = CompanySubscription::class;
    public $route = 'company-subscriptions';
    public $page_title = 'Company Subscriptions';
    public $action_title = 'Company Subscription';
}
