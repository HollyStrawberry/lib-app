@extends('layouts.main')
@section('content')
    <div>
        <form action="{{ route('book.store') }}" method="post">
            @csrf
            <input name="title" class="form-control form-control-lg" type="text" placeholder="Title">
            <input name="pub_type" class="form-control" type="text" placeholder="Type">
            <input name="genre" class="form-control form-control-sm" type="text" placeholder="Genre">
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
