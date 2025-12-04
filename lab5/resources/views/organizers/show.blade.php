@extends('layouts.app')

@section('content')
    <h1>Организатор: {{ $organizer->name }}</h1>

    <p><strong>Email:</strong> {{ $organizer->email }}</p>
    <p><strong>Телефон:</strong> {{ $organizer->phone }}</p>

    <hr>

    <h3>Настани од овој организатор</h3>

    @if($organizer->events->count())
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Име</th>
                <th>Тип</th>
                <th>Датум</th>
                <th>Акции</th>
            </tr>
            </thead>
            <tbody>
            @foreach($organizer->events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->type }}</td>
                    <td>{{ $event->date }}</td>
                    <td>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">Погледни</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>Овој организатор нема настани.</p>
    @endif
@endsection
