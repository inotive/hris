<?php

namespace App\Http\Controllers;

use App\Helpers\PayoutSettingHelper;
use App\Models\Company;
use App\Models\CompanyPayoutSetting;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CompanyPayoutSettingController extends Controller
{
    // use CrudTrait;

    // public $model = CompanyPayoutSetting::class;
    // public $route = 'company-payout-settings';
    // public $page_title = 'Company Payout Setting';


    public function calendar(Company $company, $year, Request $request)
    {
        
        $payouts = PayoutSettingHelper::generate($company->id, $year);

        $tabs = [];
        for ($i = date('Y'); $i < date('Y') + 5; $i++) {
            $tabs[] = [
                'code' => $i,
                'route' => route('companies.payout-setting', [$company, $i]),
                'label' => $i,
            ];
        }

        return view('company_payout_settings.calendar', [
            'payouts' => $payouts,
            'tabs' => $tabs,
            'active_tab' => $year,
            'company' => $company,
            'form_action' => route('companies.payout-setting.update', [$company, $year]),
            'cancel' => route('companies.index'),
        ]);
    }

    public function calendarUpdate(Company $company, $year, Request $request)
    {
        $payouts = $request->payouts ?? [];

        foreach ($payouts as $key => $value) {
            $form = CompanyPayoutSetting::where('company_id', $company->id)
                ->whereYear('date', $year)
                ->whereMonth('date', $key)
                ->first() ?? new CompanyPayoutSetting();
            $form->date = $value;
            $form->company_id = $company->id;
            $form->save();
        }

        $message = __('Data Saved Successfully');
        session()->flash('messages', [
            'success' => $message,
        ]);


        return [
            'success' => true,
            'message' => $message,
            'redirect' => route('companies.payout-setting', [$company, $year]),
        ];
    }
}
