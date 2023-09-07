<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookGenreRelations;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;
use Throwable;

class BookController extends Controller
{

    public function index(Request $request) {


        $genres_all = Genre::all();
        $authors_all = User::all();



        if ($request->all()) {
            if ($request->user_id)
                $books = Book::whereIn('user_id',$request->user_id)
                    ->where('title','like','%'. $request->title .'%')
                    ->whereHas('genres',function ($q) use ($request) {
                        $q->whereIn('name', $request->check_genre);
                    })
                    ->get();

        } else {
            $books = Book::all();
        }


        $data = [
            'books' => $books,
            'genres_all' => $genres_all,
            'authors_all' => $authors_all,
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

    public function destroy(Request $request) {

        $book = Book::find($request->id);

        Log::info('Deleting book with id: '.$book->id.' and title '.$book->title);
        $book->delete();
        Log::info('Book was deleted');
        return redirect()->route('book.index');
    }

    public function store(Request $request) {
        if ($request->validated()) {

            try {
                $book = Book::create([
                    'title' => $request->title,
                    'pub_type' => $request->pub_type,
                    'user_id' => auth()->id(),
                ]);

                GenreController::setBookGenres($book->id, $request->genre);

                Log::info('Created book with id: '.$book->id.' and title '.$book->title);
            } catch (Throwable $e) {
                report($e);
            }
            return redirect()->route('book.index');
        } else {
            return redirect()->route('book.create');
        }
    }

    public function storeUpdates(Request $request) {
        if ($request->validated()) {

            try {
                $book = Book::find($request->id);
                Log::info('Updating books data with id: '.$book->id.' and title '.$book->title);
                $book->update([
                    'title' => $request->title,
                    'pub_type' => $request->pub_type,
                ]);


                GenreController::updateBookGenres($book->id, $request->genre);
                Log::info('Updated book with id: '.$book->id.' and title '.$book->title);
            } catch (Throwable $e) {
                report($e);
            }
            return redirect()->route('book.index');
        } else {
            return redirect()->route('book.update');
        }
    }
}
