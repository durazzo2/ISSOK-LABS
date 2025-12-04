@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Организатори</h1>
        <a href="{{ route('organizers.create') }}" class="btn btn-primary">Нов организатор</a>
    </div>

    @if($organizers->count())
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Име и презиме</th>
                <th>Email</th>
                <th>Телефон</th>
                <th># Настани</th>
                <th>Акции</th>
            </tr>
            </thead>
            <tbody>
            @foreach($organizers as $organizer)
                <tr>
                    <td>{{ $organizer->id }}</td>
                    <td>{{ $organizer->name }}</td>
                    <td>{{ $organizer->email }}</td>
                    <td>{{ $organizer->phone }}</td>
                    <td>{{ $organizer->events_count }}</td>
                    <td>
                        <a href="{{ route('organizers.show', $organizer) }}" class="btn btn-sm btn-info">Погледни</a>
                        <a href="{{ route('organizers.edit', $organizer) }}" class="btn btn-sm btn-warning">Уреди</a>
                        <form action="{{ route('organizers.destroy', $organizer) }}" method="POST" class="d-inline"
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

        {{-- Пагинација --}}
        {{ $organizers->links() }}
    @else
        <p>Нема организатори.</p>
    @endif
@endsection
