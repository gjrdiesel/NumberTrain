<?php

namespace App\Console\Commands;

use App\Jobs\FetchUserStats;
use Illuminate\Console\Command;

class FetchFollowerCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nt:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kick off fetching all the latest follower counts for all users';

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
        \App\User::chunk(100, function ($users) {
            foreach ($users as $user) {
                dispatch(new FetchUserStats($user));
            }
        });
    }
}
