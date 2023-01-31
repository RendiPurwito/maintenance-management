<?php

namespace App\Console;

use App\Models\User;
use jazmy\FormBuilder\Models\Form;
use Illuminate\Support\Facades\Log;
use jazmy\FormBuilder\Models\Submission;
use Illuminate\Console\Scheduling\Schedule;
use pp\Console\Commands\PruneSoftDeletedUsers;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        'App\Console\Commands\PruneSoftDeletedUsers',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Prune Users Soft Deleted
        $schedule->call(function () {
            User::onlyTrashed()->forceDelete();
        })->daily();

        // Prune Users Soft Deleted
        $schedule->call(function () {
            Form::onlyTrashed()->forceDelete();
        })->daily();

        // Prune Users Soft Deleted
        $schedule->call(function () {
            Submission::onlyTrashed()->forceDelete();
        })->daily();
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

}
