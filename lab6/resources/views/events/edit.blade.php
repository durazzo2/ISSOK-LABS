@extends('layouts.app')

@section('content')
    <h1>Edit Event</h1>

    <form method="POST" action="{{ route('events.update', $event->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $event->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"
                      required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control" required>
                <option value="seminar" {{ $event->type == 'seminar' ? 'selected' : '' }}>Seminar</option>
                <option value="workshop" {{ $event->type == 'workshop' ? 'selected' : '' }}>Workshop</option>
                <option value="lecture" {{ $event->type == 'lecture' ? 'selected' : '' }}>Lecture</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $event->date) }}" required>
        </div>

        <div class="mb-3">
            <label>Organizer</label>
            <select name="organizer_id" class="form-control" required>
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ $event->organizer_id == $organizer->id ? 'selected' : '' }}>
                        {{ $organizer->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
