<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\CronController;
class send_mail_to_will_expire_plan_soon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:send_mail_to_will_expire_plan_soon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will work when user plan will expire soon';

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
     * @return int
     */
    public function handle()
    {
        $cron = new CronController;
        $cron->run_SendMailToWillExpirePlanWithInDay();
    }
}
