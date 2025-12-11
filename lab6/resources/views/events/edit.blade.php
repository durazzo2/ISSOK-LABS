@extends('layouts.app')

@section('content')
    <h1>Edit Event</h1>

    <form method="POST" action="{{ route('events.update', $event) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" value="{{ $event->name }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <input name="type" class="form-control" value="{{ $event->type }}" required>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" value="{{ $event->date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Organizer</label>
            <select name="organizer_id" class="form-control" required>
                @foreach($organizers as $o)
                    <option value="{{ $o->id }}" @if($event->organizer_id == $o->id) selected @endif>
                        {{ $o->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-warning">Update</button>
    </form>
@endsection
