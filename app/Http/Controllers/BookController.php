<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookGenreRelations;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {

        $books = Book::all();

        $genres_array = [];

        foreach ($books as $book) {
            $genres = '';
            $relations = BookGenreRelations::where('book_id', $book->id)->get();

            foreach ($relations as $relation) {
                $genres .= Genre::find($relation->genre_id)->name . ", ";
            }

            $genres_array[$book->id - 1] = $genres;
        }

        return view('book.index',compact('books'),compact('genres_array'));
    }

    public function create() {

        return view('book.create');
    }

    public function update() {

        $book = Book::find(1);

    }

    public function delete() {

    }

    public function store(Request $request) {
        $data = request()->validate([
            'title' => 'string',
            'pub_type' => 'string|in:graphical,digital,printed',
            'genre' => 'string',
        ]);

        $genres = explode(', ', $request->genre);

        $book = Book::create([
            'title' => $request->title,
            'pub_type' => $request->pub_type,
            'user_id' => 1,
        ]);

        foreach ($genres as $genre_str) {
            $genre = Genre::firstWhere('name',$genre_str);

            if ($genre == null) {
                $genre = Genre::create([
                    'name' => $genre_str,
                ]);
            }

            BookGenreRelations::create([
                'book_id' => $book->id,
                'genre_id' => $genre->id,
            ]);
        }

        return redirect()->route('book.index');
    }
}
