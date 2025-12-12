<?php

namespace App\Repositories;

interface EventRepositoryInterface
{
    public function all($search = null);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
