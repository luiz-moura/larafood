<?php

namespace Infrastructure\Shared;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function create(mixed $details): bool
    {
        return $this->model->create($details);
    }

    public function update(int $id, mixed $newDetails): bool
    {
        return $this->model->whereId($id)->update($newDetails);
    }

    private function resolveModel(): mixed
    {
        return app($this->model);
    }
}
