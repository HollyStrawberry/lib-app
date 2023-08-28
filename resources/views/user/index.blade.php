@extends('layouts.app')
@section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
            @foreach($users as $user)
                    <div class="card">
                        <div class="card-header">{{ $user->name }}</div>
                        <div class="card-body">
                            Книги: {{ array_pop($books_counts) }}
                        </div>
                    </div>
            @endforeach
                    <a href="{{ route('user.create') }}">Добавить автора</a>
                </div>
            </div>
        </div>
@endsection
