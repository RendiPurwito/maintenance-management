<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use jazmy\FormBuilder\Models\Form;

class PruneForm extends Command
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
        $deletedForms = Form::onlyTrashed()
        ->whereDate('deleted_at', '<', Carbon::now()->subWeek())
        ->get();

    foreach ($deletedForms as $form) {
        $form->forceDelete();
    }
        // return Command::SUCCESS;
    }
}
