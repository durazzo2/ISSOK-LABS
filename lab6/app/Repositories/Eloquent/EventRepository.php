<?php

namespace App\Repositories\Eloquent;

use App\Models\Event;
use App\Repositories\EventRepositoryInterface;

class EventRepository implements EventRepositoryInterface
{
    public function all($search = null)
    {
        return Event::with('organizer')
            ->when($search, fn($q) => $q->where('name', 'LIKE', "%$search%"))
            ->paginate(10);
    }

    public function find($id)
    {
        return Event::findOrFail($id);
    }

    public function create(array $data)
    {
        return Event::create($data);
    }

    public function update($id, array $data)
    {
        $event = Event::findOrFail($id);
        $event->update($data);
        return $event;
    }

    public function delete($id)
    {
        return Event::destroy($id);
    }
}
