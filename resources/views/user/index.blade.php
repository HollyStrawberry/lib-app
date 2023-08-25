@extends('layouts.main')
@section('content')
        <div>
            <h1>Users</h1>
            @foreach($users as $user)
                <p> ID: {{ $user->id }}
                <p> User: {{ $user->name }}
                <p> Password: {{ $user->password }}
                <p> Books: {{ $books_counts[$user->id - 1] }}
            @endforeach
        </div>
        <div>
            <a href="{{ route('user.create') }}">Добавить автора</a>
        </div>
@endsection
