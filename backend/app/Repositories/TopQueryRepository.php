<?php

namespace App\Repositories;

use App\Models\TopQuery;

class TopQueryRepository
{
    protected $model;

    public function __construct(TopQuery $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function save(array $data)
    {
        return $this->model->create($data);
    }

    public function deleteAll()
    {
        return $this->model->query()->delete();
    }
}