<?php

namespace App\Console\Commands;

use App\Mail\TestEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailTestCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:email-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Test Command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Mail::to('bayuly94@gmail.com')->queue(new TestEmail());

        $this->info('Email has been queued successfully.');

        

        return Command::SUCCESS;
    }
}
