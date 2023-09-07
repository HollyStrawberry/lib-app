<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;

class BookApiController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function store(BookRequest $request)
    {
        $day = Book::create($request->validated());
        return $day;
    }

    public function show($id)
    {
        return $book = Book::findOrFail($id);
    }

    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->fill($request->except(['book_id']));
        $book->save();
        return response()->json($book);
    }

    public function destroy(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        if($book->delete()) return response(null, 204);
    }
}
