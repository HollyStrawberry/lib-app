@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                    <form class="justify-center" method="GET" action="{{route('book.index')}}">
                        <div class="row mb-3">
                            <label for="search" class="col-md-4 col-form-label text-md-end">Поиск</label>
                            <div class="col-md-6">
                                <input type="search" class="form-control" name="title" value="{{ old('title') }}"/>
                            </div>
                        </div>
                        <p>Жанры</p>
                    @foreach($data['genres_all'] as $genre)
                        <label for="check_genre">{{ $genre->name }}</label>
                        <input type="checkbox" name="check_genre[]" id="check_genre" value="{{ $genre->name }}">
                    @endforeach
                        <p>Авторы</p>
                    @foreach($data['authors_all'] as $author)
                        <label for="check_author">{{ $author->name }}</label>
                        <input type="checkbox" name="user_id[]" id="user_id" value="{{ $author->id }}">
                    @endforeach
                        <p></p>
                        <input type="submit" name="submit" id="submit">
                </form>
    @foreach($data['books'] as $book)
        <div class="card">
            <div class="card-header">
                {{ $book->title }}
                <div align="right">
                    {{ $book->user->name }}
                </div>
            </div>
            <div class="card-body">
                Жанры:
                @foreach($book->genres()->orderBy('name')->get() as $genre) {{
                        $genre->name
                        }}
                @endforeach
                <p>Издание: {{ $book->pub_type }}
                <p>Дата: {{ $book->created_at }}
                @auth()
                    @if(auth()->id() == $book->user_id)
                <form method="GET" id="edit_delete" align="right">
                    <button id="button_update" type="submit" name="id" value="{{ $book->id }}" formaction="{{ route('book.update') }}">Редактировать</button>
                    <button id="button_delete" type="submit" name="id" value="{{ $book->id }}" formaction="{{ route('book.delete') }}">Удалить</button>
                </form>
                    @endif
                @endauth
            </div>
        </div>
    @endforeach
            </div>
        </div>
    </div>
    <div>

    </div>
@endsection
