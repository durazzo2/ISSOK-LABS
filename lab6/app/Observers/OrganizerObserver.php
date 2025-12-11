<?php

namespace App\Observers;

use App\Models\Organizer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrganizerObserver
{
    public function created(Organizer $organizer)
    {
        // кратка нотификација за корисникот во сесија
        Session::flash('success', "Нов организатор е креиран: {$organizer->full_name}");
    }

    public function updated(Organizer $organizer)
    {
        Log::info("Organizer updated: ID {$organizer->id} ({$organizer->email})");
    }

    public function deleted(Organizer $organizer)
    {
        Log::info("Organizer deleted: ID {$organizer->id} ({$organizer->email})");
    }
}
