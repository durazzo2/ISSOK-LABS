<?php

namespace App\Http\Controllers;

use App\Services\EventService;
use App\Services\OrganizerService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    protected $events;
    protected $organizers;

    public function __construct(EventService $events, OrganizerService $organizers)
    {
        $this->events = $events;
        $this->organizers = $organizers;
    }

    public function index(Request $request)
    {
        $events = $this->events->getAll($request->search);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $organizers = $this->organizers->getAll();
        return view('events.create', compact('organizers'));
    }

    public function store(Request $request)
    {
        $this->events->store($request->all());
        return redirect()->route('events.index');
    }

    public function edit($id)
    {
        $event = $this->events->events->find($id);
    }

    public function update(Request $request, $id)
    {
        $this->events->update($id, $request->all());
        return redirect()->route('events.index');
    }

    public function destroy($id)
    {
        $this->events->delete($id);
        return redirect()->route('events.index');
    }
}
