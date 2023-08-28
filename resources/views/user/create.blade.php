@extends('layouts.app')
@section('content')
        <div>
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <input name="name" class="form-control form-control-lg" type="text" placeholder="Имя">
                <input name="password" class="form-control" type="password" placeholder="Пароль">
                <button type="submit" class="btn btn-primary">Зарегестрировать</button>
            </form>
        </div>
@endsection
