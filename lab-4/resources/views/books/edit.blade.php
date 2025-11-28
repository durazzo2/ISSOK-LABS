<!DOCTYPE html>
<html lang="mk">
<head>
    <meta charset="UTF-8">
    <title>Ажурирај книга</title>
</head>
<body>
<h1>Ажурирај книга</h1>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Наслов:</label><br>
    <input type="text" name="title" value="{{ old('title', $book->title) }}"><br><br>

    <label>Автор:</label><br>
    <input type="text" name="author" value="{{ old('author', $book->author) }}"><br><br>

    <label>Година на издавање:</label><br>
    <input type="number" name="year" value="{{ old('year', $book->year) }}"><br><br>

    <label>ISBN:</label><br>
    <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}"><br><br>

    <label>Жанр:</label><br>
    <input type="text" name="genre" value="{{ old('genre', $book->genre) }}"><br><br>

    <label>Име и презиме на лицето што ја изнајмило книгата (опц.):</label><br>
    <input type="text" name="renter_name" value="{{ old('renter_name', $book->renter_name) }}"><br><br>

    <label>Датум на изнајмување (опц.):</label><br>
    <input type="date" name="rent_date" value="{{ old('rent_date', $book->rent_date) }}"><br><br>

    <label>Датум за враќање (опц.):</label><br>
    <input type="date" name="return_date" value="{{ old('return_date', $book->return_date) }}"><br><br>

    <button type="submit">Зачувај промени</button>
</form>

<br>
<a href="{{ route('books.index') }}">Назад кон списокот</a>
</body>
</html>
