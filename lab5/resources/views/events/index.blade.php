@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Настани</h1>
        <a href="{{ route('events.create') }}" class="btn btn-primary">Нов настан</a>
    </div>

    <form method="GET" action="{{ route('events.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Пребарај настани..."
                   value="{{ request('search') }}">

            <button class="btn btn-primary">Пребарај</button>

            @if(request('search'))
                <a href="{{ route('events.index') }}" class="btn btn-secondary">Ресет</a>
            @endif
        </div>
    </form>


    @if($events->count())
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Име</th>
                <th>Тип</th>
                <th>Датум</th>
                <th>Организатор</th>
                <th>Акции</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->type }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->organizer?->name }}</td>
                    <td>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">Погледни</a>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning">Уреди</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Дали си сигурен?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Избриши</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $events->links() }}
    @else
        <p>Нема настани.</p>
    @endif
@endsection
