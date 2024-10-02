<?php

namespace App\Console\Commands;

use App\Services\AttendanceService;
use Illuminate\Console\Command;

class AttendanceInitCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert All Employee to Attendance table (default status 0)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        AttendanceService::init();
        
        return Command::SUCCESS;
    }
}
