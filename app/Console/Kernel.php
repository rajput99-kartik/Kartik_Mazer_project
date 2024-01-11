<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
     
     protected $commands = [
        \App\Console\Commands\DemoCron::class,
        \App\Console\Commands\CarrierPacketCron::class,
    ];
    
    
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->everyMinute();
        $schedule->command('demo:cron')
                 ->everyMinute();
		
		
		$schedule->command('token:cron')
                 ->everyMinute();
				 
		$schedule->command('carrierpacket:cron')
                 ->weekly()->withoutOverlapping();
				 
		
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
	
	/**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    
	
	
}
