<?php

namespace App\Jobs;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PruneOldPostsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Post::where('created_at', '<', Carbon::now()->subYears(2))->delete();
    }
}
