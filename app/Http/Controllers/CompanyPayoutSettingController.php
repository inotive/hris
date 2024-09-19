<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyPayoutSetting;
use App\Traits\CrudTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CompanyPayoutSettingController extends Controller
{
    // use CrudTrait;

    // public $model = CompanyPayoutSetting::class;
    // public $route = 'company-payout-settings'; 
    // public $page_title = 'Company Payout Setting';


    public function calendar(Company $company, $year, Request $request)
    {
        $general_pay_date = $company->general_pay_date;

        $payouts = [];
        for($i = 1; $i <= 12; $i++) {
            $setting = CompanyPayoutSetting::whereYear('date', $year)->whereMonth('date', $i)->where('company_id', $company->id)->first();
            if ($setting == null) {
                $setting = new CompanyPayoutSetting();
                $setting->company_id = $company->id;
                $setting->date = $year . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-' . str_pad($general_pay_date, 2, "0", STR_PAD_LEFT);
                $setting->save();
            }
            $payouts[] = $setting;
        }

        $tabs = [];
        for($i = date('Y'); $i < date('Y') + 5; $i++) {
            $tabs[] = [
                'code'  => $i,
                'route' => route('companies.payout-setting', [$company, $i]),
                'label' => $i,
            ];
        }

        return view('company_payout_settings.calendar',[
            'payouts'   => $payouts,
            'tabs'  => $tabs,
            'active_tab'    => $year,
            'company'   => $company,
            'form_action'   => route('companies.payout-setting.update', [$company, $year]),
            'cancel'    => route('companies.index'),
        ]);
    }

    public function calendarUpdate(Company $company, $year, Request $request)
    {
        $payouts = $request->payouts ?? [];

        foreach($payouts as $key => $value) {
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
            'success'   =>  $message,
        ]);


        return [
            'success'   => true,
            'message'   => $message,
            'redirect'  => route('companies.payout-setting',[$company, $year]),
        ];
    }
}
