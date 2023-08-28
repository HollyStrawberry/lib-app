@extends('layouts.app')
@section('content')
    <div>
        <form action="{{ route('genre.store') }}" method="post">
            @csrf
            <input name="name" class="form-control form-control-lg" type="text" placeholder="Название жанра">
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
@endsection
