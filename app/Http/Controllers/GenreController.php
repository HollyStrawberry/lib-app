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

    public function store(Request $request) {
        if ($this->validate($request, $this->rules)) {

            $genre = Genre::create([
                'name' => $request->name,
            ]);

            return redirect()->route('genre.index');
        } else {
            return redirect()->route('genre.create');
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

    public static function setBookGenres(Int $book_id, string $genres_str) {
        $genres = explode(',',
            preg_replace('/\s+/', '', $genres_str));

        foreach ($genres as $genre_str) {
            $genre = Genre::firstWhere('name', $genre_str);

            if ($genre == null) {
                $genre = Genre::create([
                    'name' => $genre_str,
                ]);
            }

            BookGenreRelations::create([
                'book_id' => $book_id,
                'genre_id' => $genre->id,
            ]);
        }
    }

    public static function updateBookGenres(Int $book_id, string $new_genres_str) {
        $relations = BookGenreRelations::where('book_id',$book_id)->get();
        $relations->delete();

        self::setBookGenres($book_id,$new_genres_str);
    }

}
