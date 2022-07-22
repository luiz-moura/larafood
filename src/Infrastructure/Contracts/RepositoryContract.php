<?php

namespace Infrastructure\Contracts;

interface RepositoryContract
{
    public function getAll();
    public function findById(int $id);
    public function delete(int $id): bool;
    public function create(mixed $details): bool;
    public function update(int $id, mixed $newDetails): bool;
}
