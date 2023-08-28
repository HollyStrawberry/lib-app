<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookGenreRelations;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use SQLiteException;
use Throwable;

class BookController extends Controller
{
    protected $rules = [
        'title' => 'string',
        'pub_type' => 'string|in:graphical,digital,printed',
        'genre' => 'string',
        ];

    public function index() {

        $books = Book::all();

        $genres_array = [];
        $authors = [];

        foreach ($books as $book) {
            $genres = '';
            $relations = BookGenreRelations::where('book_id', $book->id)->get();

            foreach ($relations as $relation) {
                $genres .= Genre::find($relation->genre_id)->name . ", ";
            }

            $authors[] = User::find($book->user_id)->name;

            $genres_array[] = $genres;
        }

        $data = [
            'authors' => array_reverse($authors),
            'genres' => array_reverse($genres_array),
            'books' => $books,
        ];

        return view('book.index',compact('data'));
    }

    public function create() {

        return view('book.create');
    }

    public function update(Request $request) {

        $book = Book::find($request->id);
        $genres = '';

        $relations = BookGenreRelations::where('book_id',$book->id)->get();
        foreach ($relations as $relation)
            $genres .= Genre::find($relation->genre_id)->name . ', ';

        return view('book.update',compact('book'),compact('genres'));

    }

    public function delete(Request $request) {

        $book = Book::find($request->id);

        $book->delete();

        return redirect()->route('book.index');
    }

    public function store(Request $request) {
        if ($this->validate($request,$this->rules)) {

            try {
                $book = Book::create([
                    'title' => $request->title,
                    'pub_type' => $request->pub_type,
                    'user_id' => auth()->id(),
                ]);

                GenreController::setBookGenres($book->id, $request->genre);

            } catch (SQLiteException $e) {
                report($e);
            }
            return redirect()->route('book.index');
        } else {
            return redirect()->route('book.create');
        }
    }

    public function storeUpdates(Request $request) {
        if ($this->validate($request, $this->rules)) {

            try {
                $book = Book::find($request->id);
                $book->update([
                    'title' => $request->title,
                    'pub_type' => $request->pub_type,
                ]);


                GenreController::updateBookGenres($book->id, $request->genre);

            } catch (SQLiteException $e) {
                report($e);
            }
            return redirect()->route('book.index');
        } else {
            return redirect()->route('book.update');
        }
    }
}
