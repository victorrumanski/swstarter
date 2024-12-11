<?php

namespace App\Services;

use App\Repositories\MetricRepository;
use Illuminate\Support\Facades\Log;

class MetricService
{
    protected $repository;

    public function __construct(MetricRepository $repository)
    {
        $this->repository = $repository;
    }

    public function save(array $data)
    {
        $this->repository->save($data);
    }
}