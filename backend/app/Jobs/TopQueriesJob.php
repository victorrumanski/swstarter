<?php

namespace App\Jobs;

use App\Services\TopQueryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class TopQueriesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        
    }

    /**
     * Execute the job.
     */
    public function handle(TopQueryService $topQueryService): void
    {
        $topQueryService->calculate();
    }
}