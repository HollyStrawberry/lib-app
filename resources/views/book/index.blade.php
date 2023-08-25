@extends('layouts.main')
@section('content')
    @foreach($books as $book)
    <div>
        <p>Название: {{ $book->title }}
        <p>Жанры: {{ $genres_array[$book->id - 1] }}
        <p><button>Редактировать</button><button>Удалить</button>
    </div>
    @endforeach
    <div>
        <a href="{{ route('book.create') }}">Добавить книгу</a>
    </div>
@endsection
