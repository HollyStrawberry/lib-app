@extends('layouts.app')
@section('content')
    <div>

        <form action="{{ route('genre.store') }}" method="post">
            @csrf
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Название') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" autocomplete="name" autofocus>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Добавить') }}
                    </button>
                    <button class="btn btn-primary" onclick="window.history.back(); return false;">
                        {{ __('Отмена') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
