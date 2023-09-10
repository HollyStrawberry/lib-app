@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- TODO: Make filtering good -->
                <!-- Search and filters -->
                    <form class="justify-center" method="GET" action="{{route('book.index')}}">
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">Поиск</label>
                            <div class="col-md-6">
                                <input type="search" class="form-control" id="title" name="title" value="{{ old('title') }}"/>
                            </div>
                        </div>
                        <p>Жанры</p>
                    @foreach($data['genres_all'] as $genre)
                        <label for="check_genre">{{ $genre->name }}</label>
                        <input type="checkbox" name="check_genre[]" id="check_genre" value="{{ $genre->id }}">
                    @endforeach
                        <p>Авторы</p>
                    @foreach($data['authors_all'] as $author)
                        <label for="check_author">{{ $author->name }}</label>
                        <input type="checkbox" name="user_id[]" id="user_id" value="{{ $author->id }}">
                    @endforeach
                        <p></p>
                        <input type="submit" name="submit" id="submit">
                </form>
    <!-- Books list -->
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
                <!-- Delete and edit buttons -->
                <form method="GET" id="edit" action="{{ route('book.edit') }}" align="right">
                    <button id="button_update" type="submit" name="id" value="{{ $book->id }}">Редактировать</button>
                </form>

                <form method="POST" id="delete" align="right" action="{{ route('book.delete', ['book' => $book]) }}">
                    @method('DELETE')
                    @csrf
                    <button id="button_delete" type="submit" name="delete" value="{{ $book->id }}">Удалить</button>
                </form>
            </div>
        </div>
    @endforeach
            </div>
        </div>
    </div>
@endsection
