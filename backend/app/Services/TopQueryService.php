<?php

namespace App\Services;

use App\Repositories\TopQueryRepository;

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
}