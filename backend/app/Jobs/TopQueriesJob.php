<?php

namespace App\Jobs;

use App\Services\TopQueryService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopQueriesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // protected $topQueryService;


    public function __construct()
    {
        // $this->topQueryService = $topQueryService;
    }

    /**
     * Execute the job.
     */
    public function handle(TopQueryService $topQueryService): void
    {

        $topQueryService->deleteAll();

        $query = "select metric_type, metric_data, count(1) totalhits" .
            " , count(1) * 100 /  total.t AS percent" .
            " from metrics" .
            " cross join (select count(1) t from metrics) total" .
            " group by metric_type, metric_data, total.t" .
            " order by percent desc limit 5";
        DB::statement($query);

        $results = DB::select($query);

        foreach ($results as $r) {
            $topQueryService->save([
                'query_type' => $r->metric_type,
                'query_string' => $r->metric_data,
                'query_count' => $r->totalhits,
                'percent' => $r->percent
            ]);
        }
    }
}