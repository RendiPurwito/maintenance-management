<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use jazmy\FormBuilder\Models\Form;

class PruneSubmission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deletedSubmissions = Form::onlyTrashed()
        ->whereDate('deleted_at', '<', Carbon::now()->subWeek())
        ->get();

    foreach ($deletedSubmissions as $submission) {
        $submission->forceDelete();
    }
        // return Command::SUCCESS;
    }
}
