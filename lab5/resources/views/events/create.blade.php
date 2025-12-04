@extends('layouts.app')

@section('content')
    <h1>Нов настан</h1>

    <form action="{{ route('events.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label class="form-label">Име на настан *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Краток опис *</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Тип на настан *</label>
            <input type="text" name="type" class="form-control" value="{{ old('type') }}">
            {{-- или dropdown ако сакаш фиксни вредности --}}
            @error('type')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Датум *</label>
            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
            @error('date')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Организатор *</label>
            <select name="organizer_id" class="form-control">
                <option value="">-- Избери организатор --</option>
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}" @selected(old('organizer_id') == $organizer->id)>
                        {{ $organizer->name }} ({{ $organizer->email }})
                    </option>
                @endforeach
            </select>
            @error('organizer_id')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success">Зачувај</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
