<?php

namespace Infrastructure\Shared;

abstract class AbstractRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function getAll(): ?array
    {
        return $this->model->all()?->toArray();
    }

    public function findById(int $id): ?object
    {
        return $this->model->find($id)?->toArray();
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id);
    }

    public function create(object $details): bool
    {
        return $this->model->create($details);
    }

    public function update(int $id, object $newDetails): bool
    {
        return $this->model->whereId($id)->update($newDetails);
    }

    private function resolveModel(): mixed
    {
        return app($this->modelClass);
    }
}
