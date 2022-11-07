<?php

namespace Infrastructure\Shared;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    private function resolveModel(): Model
    {
        return app($this->modelClass);
    }
}
