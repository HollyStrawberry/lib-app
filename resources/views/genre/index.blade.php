@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
    @foreach($genres as $genre)
                <div class="card">
                    <div class="card-header">{{ $genre->name }}
                    @auth()
                        <form method="GET" id="edit_delete" align="right">
                            <button id="button_update" type="submit" name="id" value="{{ $genre->id }}" formaction="{{ route('genre.update') }}">Редактировать</button>
                            <button id="button_delete" type="submit" name="id" value="{{ $genre->id }}" formaction="{{ route('genre.delete') }}">Удалить</button>
                        </form>
                    @endauth
                    </div>
                </div>
    @endforeach
                <div class="card">
                    <div class="card-header"><a href="{{ route('genre.create') }}">Добавить жанр</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
