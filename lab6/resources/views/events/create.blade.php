@extends('layouts.app')

@section('content')
    <h1>Create Event</h1>

    <form method="POST" action="{{ route('events.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label>Type</label>
            <input name="type" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Organizer</label>
            <select name="organizer_id" class="form-control" required>
                @foreach($organizers as $o)
                    <option value="{{ $o->id }}">{{ $o->full_name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
@endsection
