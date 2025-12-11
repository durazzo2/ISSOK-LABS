@extends('layouts.app')

@section('content')
    <h1>{{ $organizer->full_name }}</h1>

    <p><strong>Email:</strong> {{ $organizer->email }}</p>
    <p><strong>Phone:</strong> {{ $organizer->phone }}</p>

    <hr>

    <h3>Events</h3>

    @if($events->count() == 0)
        <p>No events.</p>
    @else
        <table class="table table-bordered">
            @foreach($events as $e)
                <tr>
                    <td>{{ $e->name }}</td>
                    <td>{{ $e->date }}</td>
                    <td><a href="{{ route('events.show', $e) }}" class="btn btn-sm btn-info">View</a></td>
                </tr>
            @endforeach
        </table>
    @endif

@endsection
