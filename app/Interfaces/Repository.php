<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements Repositoriable
{
    protected object $model;
    public int $paginate;

    public function getAll(): Collection
    {
        return $this->model->get();
    }
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function store(array|object $data): object
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array|object $data): bool
    {
        return $model->update($data);
    }

    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }


}
