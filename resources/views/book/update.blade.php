@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
        <form action="{{ route('book.update',['book' => $book]) }}" method="post">
            @method('PUT')
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <div class="row mb-3">
                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Название') }}</label>
                <div class="col-md-6">
                    <input id="title" type="text" class="form-control" name="title" value="{{ $book->title }}" autocomplete="title" autofocus>
                </div>
            </div>

            <div class="row mb-3">
                <label for="pub_type" class="col-md-4 col-form-label text-md-end">{{ __('Вид издания') }}</label>

                <div class="col-md-6">
                    <select id="pub_type" class="form-control" name="pub_type">
                        <option value="graphical">Графическое</option>
                        <option value="printed">Печатное</option>
                        <option value="digital">Цифровое</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="genre" class="col-md-4 col-form-label text-md-end">{{ __('Жанры') }}</label>

                <div class="col-md-6">
                    <input id="genre" type="text" class="form-control" name="genre" value="@foreach($book->genres()->get() as $genre) {{ $genre->name . ',' }} @endforeach" placeholder="Через запятую">
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary" name="id" value="{{ $book->id }}">
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
        </div>
    </div>
@endsection
