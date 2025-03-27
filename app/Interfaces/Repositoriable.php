<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface Repositoriable
{
    public function getById($id);
    public function store(array|object $data): object;
    public function update(Model $model, array|object $data): bool;
    public function delete(Model $model): ?bool;

}
