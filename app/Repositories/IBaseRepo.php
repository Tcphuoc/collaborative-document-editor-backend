<?php

namespace App\Repositories;

interface IBaseRepo
{
    public function create(array $attributes);

    public function update(int|string $id, array $attributes);
}
