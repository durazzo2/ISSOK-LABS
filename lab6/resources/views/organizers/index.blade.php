@extends('layouts.app')

@section('content')
    <h1>Organizers</h1>

    <a href="{{ route('organizers.create') }}" class="btn btn-success mb-3">Add Organizer</a>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($organizers as $o)
            <tr>
                <td>{{ $o->full_name }}</td>
                <td>{{ $o->email }}</td>
                <td>{{ $o->phone }}</td>
                <td>
                    <a href="{{ route('organizers.show', $o) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('organizers.edit', $o) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('organizers.destroy', $o) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $organizers->links() }}
@endsection
