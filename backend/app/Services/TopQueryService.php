<?php

namespace App\Services;

use App\Repositories\TopQueryRepository;
use Illuminate\Support\Facades\DB;

class TopQueryService
{
    protected $repository;

    public function __construct(TopQueryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function save(array $data)
    {
        $this->repository->save($data);
    }

    public function deleteAll()
    {
        $this->repository->deleteAll();
    }

    public function calculate()
    {
        DB::transaction(function () {
            $this->deleteAll();
            $query = "select metric_type, metric_data, count(1) totalhits" .
                " , count(1) * 100 /  total.t AS percent" .
                " from metrics" .
                " cross join (select count(1) t from metrics) total" .
                " group by metric_type, metric_data, total.t" .
                " order by percent desc limit 5";
            DB::statement($query);

            $results = DB::select($query);

            foreach ($results as $r) {
                $this->save([
                    'query_type' => $r->metric_type,
                    'query_string' => $r->metric_data,
                    'query_count' => $r->totalhits,
                    'percent' => $r->percent
                ]);
            }
        }, 1); // <= This is used to handle Deadlocks, and is the number of tries.

    }
}