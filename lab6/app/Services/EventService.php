<?php

namespace App\Services;

use App\Repositories\EventRepositoryInterface;

class EventService
{
    protected $events;

    public function __construct(EventRepositoryInterface $events)
    {
        $this->events = $events;
    }

    public function getAll($search = null)
    {
        return $this->events->all($search);
    }

    public function store(array $data)
    {
        return $this->events->create($data);
    }

    public function update($id, array $data)
    {
        return $this->events->update($id, $data);
    }

    public function delete($id)
    {
        return $this->events->delete($id);
    }
}
