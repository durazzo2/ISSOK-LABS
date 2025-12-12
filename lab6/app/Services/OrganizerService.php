<?php

namespace App\Services;

use App\Repositories\OrganizerRepositoryInterface;

class OrganizerService
{
    protected $organizers;

    public function __construct(OrganizerRepositoryInterface $organizers)
    {
        $this->organizers = $organizers;
    }

    public function getAll()
    {
        return $this->organizers->all();
    }

    public function getById($id)
    {
        return $this->organizers->find($id);
    }

    public function store(array $data)
    {
        return $this->organizers->create($data);
    }

    public function update($id, array $data)
    {
        return $this->organizers->update($id, $data);
    }

    public function delete($id)
    {
        return $this->organizers->delete($id);
    }
}
