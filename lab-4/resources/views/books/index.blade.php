<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <title>Книги</title>
</head>
<body>
<h1>Список на книги</h1>

@if (session('success'))
    <div style="color: green;">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('books.create') }}">Додади книга</a>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>ID</th>
        <th>Наслов</th>
        <th>Автор</th>
        <th>Година</th>
        <th>ISBN</th>
        <th>Жанр</th>
        <th>Изнајмена од</th>
        <th>Датум на изнајмување</th>
        <th>Датум за враќање</th>
        <th>Акции</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>{{ $book->year }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->genre }}</td>
            <td>{{ $book->renter_name }}</td>
            <td>{{ $book->rent_date }}</td>
            <td>{{ $book->return_date }}</td>
            <td>
                <a href="{{ route('books.edit', $book->id) }}">Ажурирај</a>

                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Дали сте сигурни?')">Избриши</button>
                </form>
            </td>
        </tr>
    @endforeach

    @if($books->isEmpty())
        <tr>
            <td colspan="10">Нема внесени книги.</td>
        </tr>
    @endif
    </tbody>
</table>
<br><br>

<div>
    <strong>Вкупно книги:</strong> {{ $totalBooks }}
</div>

<div>
    <strong>Моментално изнајмени книги:</strong> {{ $currentlyLent }}
</div>

</body>
</html>
