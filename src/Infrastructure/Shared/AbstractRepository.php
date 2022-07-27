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

    public function findById(int $id): mixed
    {
        return $this->model->find($id)?->toArray();
    }

    public function delete(int $id): bool
    {
        return (bool) $this->model->destroy($id);
    }

    public function create(DataTransferObject $details): bool
    {
        return (bool) $this->model->create($details->toArray());
    }

    public function update(int $id, DataTransferObject $newDetails): bool
    {
        return (bool) $this->model->whereId($id)->update($newDetails);
    }

    private function resolveModel(): mixed
    {
        return app($this->modelClass);
    }
}
