<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Models\Book;

class BookApiController extends Controller
{
    public function index()
    {
        return new BookCollection(Book::paginate());
    }

    public function show($id)
    {
        return new BookResource(Book::findOrFail($id));
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
