<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookGenreRelations;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GenreController extends Controller
{
    /**
     * Show a list of all of the application's genres.
     */

    protected $rules = [
        'name' => 'string'
    ];

    public function index(): View
    {
        $genres = Genre::all();

        return view('genre.index', compact('genres'));
    }

    public function create() {

        return view('genre.create');
    }
    public function update(Request $request) {

        $genre = Genre::find($request->id);

        return view('genre.update', compact('genre'));
    }
    public function delete(Request $request) {

        $genre = Genre::find($request->id);

        $genre->delete();

        return redirect()->route('genre.index');
    }

    public function store(Request $request) {
        if ($this->validate($request, $this->rules)) {


            if ($request->id == null) {
                $genre = Genre::create([
                    'name' => $request->name,
                ]);
            } else {
                $genre = Genre::find($request->id);
                $genre->update([
                    'name' => $request->name,
                ]);
            }

            return redirect()->route('genre.index');
        } else {
            return null;
        }
    }

    public function getBookGenres(Int $book_id): string {

        $genres = Genre::find(BookGenreRelations::where(
                'book_id',$book_id
            )->get('genre_id')
        )->get();

        $genres_string = '';

        foreach ($genres as $genre) {
            $genres_string .= $genre->name . ', ';
        }

        return $genres_string;
    }

    public static function setBookGenres(Book $book, string $genres_str) {
        $genres = explode(',',
            preg_replace('/\s+/', '', $genres_str));

        foreach ($genres as $genre_str) {
            $genre = Genre::firstWhere('name', $genre_str);

            if ($genre == null) {
                $genre = Genre::create(['name' => $genre_str]);
            }

            $book->genres()->save($genre);
        }
    }

    public static function updateBookGenres(Book $book, string $new_genres_str) {
        $book->genres()->detach();
/*
        foreach ($book->genres()->get() as $genre) {
            $genre->delete();
        }
*/
        self::setBookGenres($book,$new_genres_str);
    }

}
