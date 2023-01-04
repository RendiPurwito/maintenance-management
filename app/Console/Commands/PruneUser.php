<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;

class PruneUser extends Command
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
        $deletedUsers = User::onlyTrashed()
        ->whereDate('deleted_at', '<', Carbon::now()->subWeek())
        ->get();

    foreach ($deletedUsers as $user) {
        $user->forceDelete();
    }
        // return Command::SUCCESS;
    }
}
