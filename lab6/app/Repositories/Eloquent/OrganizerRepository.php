<?php

namespace App\Repositories\Eloquent;

use App\Models\Organizer;
use App\Repositories\OrganizerRepositoryInterface;

class OrganizerRepository implements OrganizerRepositoryInterface
{
    public function all($search = null)
    {
        return Organizer::when($search, fn($q) =>
        $q->where('name', 'LIKE', "%$search%"))
            ->paginate(10);
    }

    public function find($id)
    {
        return Organizer::findOrFail($id);
    }

    public function create(array $data)
    {
        return Organizer::create($data);
    }

    public function update($id, array $data)
    {
        $organizer = Organizer::findOrFail($id);
        $organizer->update($data);
        return $organizer;
    }

    public function delete($id)
    {
        return Organizer::destroy($id);
    }
}
