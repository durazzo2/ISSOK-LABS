<?php
namespace App\Observers;

use App\Models\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EventObserver
{
    public function created(Event $event)
    {
        Session::flash('success', "Нов настан додаден: {$event->name}");
    }

    public function updated(Event $event)
    {
        Log::info("Event updated: ID {$event->id}, name: {$event->name}");
    }

    public function deleted(Event $event)
    {
        Log::info("Event cancelled: ID {$event->id}, name: {$event->name}");
    }
}
