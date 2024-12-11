<?php

namespace App\Repositories;

use App\Models\Metric;

class MetricRepository
{
    protected $model;

    public function __construct(Metric $model)
    {
        $this->model = $model;
    }

    public function save(array $data)
    {
        return $this->model->create($data);
    }
}
