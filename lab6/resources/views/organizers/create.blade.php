@extends('layouts.app')

@section('content')
    <h1>Create Organizer</h1>

    <form method="POST" action="{{ route('organizers.store') }}">
        @csrf

        <div class="mb-3">
            <label>First Name</label>
            <input name="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input name="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input name="phone" class="form-control" required>
        </div>

        <button class="btn btn-success">Save</button>
    </form>
@endsection
