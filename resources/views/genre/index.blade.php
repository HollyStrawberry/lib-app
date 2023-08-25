@extends('layouts.main')
@section('content')
    <div>
    @foreach($genres as $genre)
        <p>{{ $genre->name }}
    @endforeach
    </div>
    <div>
        <a href="{{ route('genre.create') }}">Добавить жанр</a>
    </div>
@endsection
