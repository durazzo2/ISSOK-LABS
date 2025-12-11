@extends('layouts.app')

@section('content')
    <h1>Events</h1>

    <a href="{{ route('events.create') }}" class="btn btn-success mb-3">Add Event</a>

    <form method="GET" class="mb-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name">
    </form>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Organizer</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($events as $event)
            <tr>
                <td>{{ $event->name }}</td>
                <td>{{ $event->organizer->full_name }}</td>
                <td>{{ $event->date }}</td>
                <td>
                    <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $events->links() }}
@endsection
