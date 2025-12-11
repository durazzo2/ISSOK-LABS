<!DOCTYPE html>
<html>
<head>
    <title>Events System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">

    <nav class="mb-4">
        <a href="{{ route('organizers.index') }}" class="btn btn-primary">Organizers</a>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Events</a>
    </nav>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>
