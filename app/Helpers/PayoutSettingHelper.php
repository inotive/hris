<?php

namespace App\Helpers;

use App\Models\Company;
use App\Models\CompanyPayoutSetting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PayoutSettingHelper {

    public static function generate($company_id, $year, $created_by_user_id = null)
    {
        $company = Company::find($company_id);

        $cut_off_payroll_date = $company->cut_off_payroll_date ?? 1;

        $payouts = [];
        for ($i = 1; $i <= 12; $i++) {
            Log::info("BULAN : " . $i);
            $setting = CompanyPayoutSetting::whereYear('date', $year)->whereMonth('date', $i)->where('company_id', $company->id)->first();
            if ($setting == null) {

                try {
                    $date = $year . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-' . str_pad($cut_off_payroll_date, 2, "0", STR_PAD_LEFT);
                    $date = Carbon::parse($date);

                    if ($date->year == $year && $date->month == $i) {

                    } else {
                        $date = Carbon::parse(date_format(date_create($year . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-01'), 'Y-m-t'));
                    }
                    Log::info($date);
                } catch (\Exception $e) {
                    $date = Carbon::parse(date_format(date_create($year . '-' . str_pad($i, 2, "0", STR_PAD_LEFT) . '-01'), 'Y-m-t'));
                }


                $setting = new CompanyPayoutSetting();
                $setting->code = $date->format('ym') . '-' . $company->id;
                $setting->company_id = $company->id;
                $setting->date = $date->format('Y-m-d');
                $setting->created_by_user_id = $created_by_user_id ?? auth()->user()->id;
                $setting->save();
            }
            $payouts[] = $setting;
        }

        return $payouts;
    }
}