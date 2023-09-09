@extends('layouts.app')
@section('content')
    <div>
        <form action="{{ route('genre.store') }}" method="post">
            @csrf
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Название') }}</label>
                <div class="col-md-6">
                    <input type="hidden" name="id" value="{{ $genre->id }}">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $genre->name }}" autofocus>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Обновить') }}
                    </button>
                    <!-- TODO: Make active cansel button -->
                    <button type="submit" class="btn btn-primary" formaction="{{ route('book.index') }}">
                        {{ __('Отмена') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
