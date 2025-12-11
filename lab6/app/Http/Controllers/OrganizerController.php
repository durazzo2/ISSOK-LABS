<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use App\Http\Requests\OrganizerRequest;

class OrganizerController extends Controller
{
    public function index()
    {
        $organizers = Organizer::orderBy('created_at', 'desc')->paginate(10);
        return view('organizers.index', compact('organizers'));
    }

    public function create()
    {
        return view('organizers.create');
    }

    public function store(OrganizerRequest $request)
    {
        Organizer::create($request->validated());
        return redirect()->route('organizers.index')->with('success', 'Organizer created successfully.');
    }

    public function show(Organizer $organizer)
    {
        $events = $organizer->events()->orderBy('date', 'asc')->get();
        return view('organizers.show', compact('organizer', 'events'));
    }

    public function edit(Organizer $organizer)
    {
        return view('organizers.edit', compact('organizer'));
    }

    public function update(OrganizerRequest $request, Organizer $organizer)
    {
        $organizer->update($request->validated());
        return redirect()->route('organizers.index')->with('success', 'Organizer updated.');
    }

    public function destroy(Organizer $organizer)
    {
        $organizer->delete();
        return redirect()->route('organizers.index')->with('success', 'Organizer deleted.');
    }
}
