@extends('layouts.app')

@section('content')
    <h1>Уреди организатор</h1>

    <form action="{{ route('organizers.update', $organizer) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Име и презиме *</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $organizer->name) }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $organizer->email) }}">
            @error('email')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Телефон *</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $organizer->phone) }}">
            @error('phone')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-success">Ажурирај</button>
        <a href="{{ route('organizers.index') }}" class="btn btn-secondary">Назад</a>
    </form>
@endsection
