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

            $query = 
            " with total as (" .
            "     select count(1) t from metrics" .
            " )," .
            " hits as (" .
            "         select metric_type, metric_data, count(1) totalhits" .
            "         from metrics" .
            "         group by metric_type, metric_data" .
            " )" .
            " select m.metric_type, m.metric_data, m.totalhits, m.totalhits * 100 / total.t as percent" .
            " from hits m join total on 1=1 " .
            " order by percent desc limit 5 ";
            
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