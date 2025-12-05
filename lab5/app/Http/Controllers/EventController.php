<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // INDEX: листа со пагинација
    public function index(Request $request)
    {
        $query = Event::with('organizer');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%")
                    ->orWhereHas('organizer', function ($org) use ($search) {
                        $org->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $events = $query->paginate(10)->appends($request->only('search'));

        return view('events.index', compact('events'));
    }


    // CREATE: форма (со избор на организатор)
    public function create()
    {
        $organizers = Organizer::all();

        return view('events.create', compact('organizers'));
    }

    // STORE: зачувување со валидации
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',          // Името на настанот е задолжително
            'description' => 'required|string|min:20',           // минимум 20 карактери
            'type' => 'required|string|max:255',          // тип е задолжителен
            'date' => 'required|date|after_or_equal:today', // датум не во минатото
            'organizer_id' => 'required|exists:organizers,id',    // мора да се избере постоечки организатор
        ]);

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Настанот е успешно креиран.');
    }

    // SHOW: еден настан
    public function show(Event $event)
    {
        $event->load('organizer');

        return view('events.show', compact('event'));
    }

    // EDIT: форма за ажурирање
    public function edit(Event $event)
    {
        $organizers = Organizer::all();

        return view('events.edit', compact('event', 'organizers'));
    }

    // UPDATE: ажурирање
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'type' => 'required|string|max:255',
            'date' => 'required|date|after_or_equal:today',
            'organizer_id' => 'required|exists:organizers,id',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Настанот е успешно ажуриран.');
    }

    // DESTROY: бришење
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Настанот е избришан.');
    }
}
