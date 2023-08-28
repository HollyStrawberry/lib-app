@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
    @foreach($data['books'] as $book)
        <div class="card">
            <div class="card-header">
                {{ $book->title }}
                <div align="right">
                    {{ array_pop($data['authors']) }}
                </div>
            </div>
            <div class="card-body">
                Жанры: {{ array_pop($data['genres']) }}
                <p>Издание: {{ $book->pub_type }}
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
