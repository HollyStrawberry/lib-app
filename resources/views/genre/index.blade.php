@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
    @foreach($genres as $genre)
                <div class="card">
                    <div class="card-header">{{ $genre->name }}</div>
                </div>
    @endforeach
                <div class="card">
                    <div class="card-header"><a href="{{ route('genre.create') }}">Добавить жанр</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection
