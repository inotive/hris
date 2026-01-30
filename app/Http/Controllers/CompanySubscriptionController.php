<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Company;
use App\Models\CompanySubscription;
use App\Models\CompanySubscriptionParent;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanySubscriptionController extends Controller
{
    use CrudTrait;

    public $model = CompanySubscriptionParent::class;
    public $route = 'company-subscriptions';
    public $page_title = 'Company Subscriptions';
    public $action_title = 'Company Subscription';


    public function addButtonHref()
    {
        return '';
    }

}
