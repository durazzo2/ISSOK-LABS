<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('organizer')->orderBy('date', 'asc');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(10)->withQueryString();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $organizers = Organizer::orderBy('first_name')->get();
        return view('events.create', compact('organizers'));
    }

    public function store(EventRequest $request)
    {
        Event::create($request->validated());
        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $event->load('organizer');
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $organizers = Organizer::orderBy('first_name')->get();
        return view('events.edit', compact('event', 'organizers'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return redirect()->route('events.index')->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }
}
