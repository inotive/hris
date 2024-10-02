<?php

namespace App\Jobs;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AttendanceInitJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public $employees)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $inserts = $this->employees->map(function($row) {

            $date = Carbon::now()->setTimezone($row->company->time_zone)->format('Y-m-d');
            return [
                'employee_id'   => $row->id,
                'employee_shift_id'   => $row->employee_shift_id,
                'date'  => $date,
            ];
        });

        foreach($inserts as $key => $value) {
            Attendance::firstOrCreate($value);
        }
    }
}
