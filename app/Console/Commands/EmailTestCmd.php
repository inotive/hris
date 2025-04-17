<?php

namespace App\Console\Commands;

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
        Mail::raw('This is a test email', function ($message) {
            $message->to('bayuly94@gmail.com')
                    ->subject('Test Email');
        });

        return Command::SUCCESS;
    }
}
