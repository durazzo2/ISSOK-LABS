@extends('layouts.app')

@section('content')
    <h1>Настан: {{ $event->name }}</h1>

    <p><strong>Опис:</strong> {{ $event->description }}</p>
    <p><strong>Тип:</strong> {{ $event->type }}</p>
    <p><strong>Датум:</strong> {{ $event->date }}</p>

    <p><strong>Организатор:</strong>
        @if($event->organizer)
            {{ $event->organizer->name }} ({{ $event->organizer->email }})
        @else
            Нема организатор.
        @endif
    </p>

    <a href="{{ route('events.index') }}" class="btn btn-secondary">Назад кон настани</a>
@endsection
