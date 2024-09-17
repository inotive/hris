<?php

namespace App\Http\Controllers;

use App\Models\CompanyPayoutSetting;
use App\Traits\CrudTrait;
use Illuminate\Http\Request;

class CompanyPayoutSettingController extends Controller
{
    use CrudTrait;

    public $model = CompanyPayoutSetting::class;
    public $route = 'company-payout-settings'; 
    public $page_title = 'Company Payout Setting';

    
}
