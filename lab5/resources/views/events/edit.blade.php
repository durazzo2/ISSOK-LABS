@extends('layouts.app')

@section('content')
    <h1>Уреди настан</h1>

    <form action="{{ route('events.update', $event) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Име на настан *</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $event->name) }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Краток опис *</label>
            <textarea name="description" class="form-control"
                      rows="4">{{ old('description', $event->description) }}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Тип на настан *</label>
            <input type="text" name="type" class="form-control"
                   value="{{ old('type', $event->type) }}">
            @error('type')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Датум *</label>
            <input type="date" name="date" class="form-control"
                   value="{{ old('date', $event->date) }}">
            @error('date')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Организатор *</label>
            <select name="organizer_id" class="form-control">
                <option value="">-- Избери организатор --</option>
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}"
                        @selected(old('organizer_id', $event->organizer_id) == $organizer->id)>
                        {{ $organizer->name }} ({{ $organizer->email }})
                    </option>
                @endforeach
            </select>
            @error('organizer_id')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success">Ажурирај</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
