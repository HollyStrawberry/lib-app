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
                        <!-- Delete and edit buttons -->
                        <form method="GET" id="edit" action="{{ route('user.edit', ['user' => $user]) }}" align="right">
                            <button id="button_update" type="submit" name="id" value="{{ $user->id }}">Редактировать</button>
                        </form>

                        <form method="POST" id="delete" align="right" action="{{ route('user.delete', ['user' => $user]) }}">
                            @method('DELETE')
                            @csrf
                            <button id="button_delete" type="submit" name="delete" value="{{ $user->id }}">Удалить</button>
                        </form>
                    </div>
            @endforeach
                </div>
            </div>
        </div>
@endsection
