<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Models\EmailNotification as EmailNotification;
use App\Http\Models\AdminRequest as AdminRequest;

class CronEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will notify user through gmail and facebook messenger.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        EmailNotification::push_email();
        AdminRequest::request_expiration();
        //\Log::info("running cron email ".\Carbon\Carbon::now());
    }
}
