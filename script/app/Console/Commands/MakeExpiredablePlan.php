<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\CronController;
class MakeExpiredablePlan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:make_expirable_user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command will work when customer will expire to plan';

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
        $cron->RunJob();

    }
}
