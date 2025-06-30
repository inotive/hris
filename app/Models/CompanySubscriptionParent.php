<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CompanySubscriptionParent extends Model
{
    use HasFactory;
    use SearchTrait;


    protected $primaryKey = 'id'; // Use 'id' as the primary key
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Since UUID is a string

    protected $table = 'companies';

    public function subscriptions()
    {
        return $this->hasMany(CompanySubscription::class, 'company_id');
    }

    public function active_subscriptions()
    {
        return $this->subscriptions()->orderBy('created_at', 'desc');
    }



    public function day_left_subscription()
    {
        try {
            $active_subscription = $this->active_subscriptions()->first();
            if ($active_subscription) {
                return Carbon::now()->diffInDays($active_subscription->end_date_at);
            }
            return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function total_day_subscription()
    {
        $active_subscription = $this->active_subscriptions()->first();
        if ($active_subscription) {
            return Carbon::parse($active_subscription->start_date_at)->diffInDays($active_subscription->end_date_at);
        }
        return 0;
    }

    public function day_left_percent_subscription()
    {
        try {
            $active_subscription = $this->active_subscriptions()->first();
            if ($active_subscription) {
                if ($this->total_day_subscription() <= 0) {
                    return 0;
                }
                return round(($this->day_left_subscription() / $this->total_day_subscription()) * 100, 0);
            }
            return 0;
        } catch (Exception $e) {
            Log::info($e);
            return 0;
        }
    }

    

    // custom query index
    public static function tableQuery()
    {
        $search = request()->search;

        $filter = request()->filter;

        $daterange = $filter['daterange'] ?? null;

        if ($daterange) {
            // 01/06/2025 - 30/06/2025

            $daterange = explode(' - ', $daterange);
            $start = \Carbon\Carbon::createFromFormat('d/m/Y', $daterange[0])->format('Y-m-d');
            $end = \Carbon\Carbon::createFromFormat('d/m/Y', $daterange[1])->format('Y-m-d');
            $daterange = $start . ' - ' . $end;
        }



        $payment_status = $filter['payment_status'] ?? null;


        $query = CompanySubscriptionParent::query()
            ->search($search)
            ->when($payment_status, function($query) use($payment_status) {
                $query->whereExists(function($subQuery) use($payment_status) {
                    $subQuery->select(DB::raw(1))
                        ->from('company_subscriptions as cs')
                        ->whereRaw('cs.company_id = companies.id')
                        ->where('cs.payment_status', $payment_status == 'YES' ? 1 : 0)
                        ->whereRaw('cs.created_at = (
                            SELECT MAX(created_at) 
                            FROM company_subscriptions 
                            WHERE company_id = companies.id
                        )');
                });
            })
            ->when($daterange, function ($query) use ($daterange) {
                $dates = explode(' - ', $daterange);
                $query->whereExists(function ($subQuery) use ($dates) {
                    $subQuery->select(DB::raw(1))
                        ->from('company_subscriptions as cs')
                        ->whereRaw('cs.company_id = companies.id')
                        ->where(function($q) use($dates) {
                            $q->whereBetween('cs.start_date_at', $dates)
                              ->orWhereBetween('cs.end_date_at', $dates);
                        })
                        ->whereRaw('cs.created_at = (
                            SELECT MAX(created_at) 
                            FROM company_subscriptions 
                            WHERE company_id = companies.id
                        )');
                });
            })
            ->paginate();

        return $query;
    }
 
}
