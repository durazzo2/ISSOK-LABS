<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrganizerController extends Controller
{
    // INDEX: листа со пагинација
    public function index()
    {
        $organizers = Organizer::withCount('events')->paginate(10);

        return view('organizers.index', compact('organizers'));
    }

    // CREATE: форма
    public function create()
    {
        return view('organizers.create');
    }

    // STORE: зачувување
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizers,email',
            'phone' => 'required|string|max:255',
        ]);

        Organizer::create($validated);

        return redirect()->route('organizers.index')
            ->with('success', 'Организаторот е успешно креиран.');
    }

    // SHOW: еден организатор + сите негови настани
    public function show(Organizer $organizer)
    {
        $organizer->load('events');

        return view('organizers.show', compact('organizer'));
    }

    // EDIT: форма за ажурирање
    public function edit(Organizer $organizer)
    {
        return view('organizers.edit', compact('organizer'));
    }

    // UPDATE: ажурирање во база
    public function update(Request $request, Organizer $organizer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('organizers', 'email')->ignore($organizer->id),
            ],
            'phone' => 'required|string|max:255',
        ]);

        $organizer->update($validated);

        return redirect()->route('organizers.index')
            ->with('success', 'Организаторот е успешно ажуриран.');
    }

    // DESTROY: бришење
    public function destroy(Organizer $organizer)
    {
        $organizer->delete();

        return redirect()->route('organizers.index')
            ->with('success', 'Организаторот е избришан.');
    }
}
