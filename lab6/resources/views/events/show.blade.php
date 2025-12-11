@extends('layouts.app')

@section('content')
    <h1>{{ $event->name }}</h1>

    <p><strong>Type:</strong> {{ $event->type }}</p>
    <p><strong>Date:</strong> {{ $event->date }}</p>
    <p><strong>Organizer:</strong> {{ $event->organizer->full_name }}</p>

    <p class="mt-3">{{ $event->description }}</p>

@endsection
