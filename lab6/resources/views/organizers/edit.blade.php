@extends('layouts.app')

@section('content')
    <h1>Edit Organizer</h1>

    <form method="POST" action="{{ route('organizers.update', $organizer) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>First Name</label>
            <input name="first_name" class="form-control" value="{{ $organizer->first_name }}" required>
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input name="last_name" class="form-control" value="{{ $organizer->last_name }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" class="form-control" value="{{ $organizer->email }}" required>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input name="phone" class="form-control" value="{{ $organizer->phone }}" required>
        </div>

        <button class="btn btn-warning">Update</button>
    </form>
@endsection
