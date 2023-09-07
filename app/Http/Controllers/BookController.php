<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    public function edit(Request $request) {

        $book = Book::find($request->id);

        return view('book.update',compact('book'));

    }

    public function destroy(Book $book) {

        Log::info('Deleting book with id: '.$book->id.' and title '.$book->title);
        $book->delete();
        Log::info('Book was deleted');
        return redirect()->route('book.index');
    }

    public function store(BookRequest $request) {

        if ($request->validated()) {

            try {
                $book = Book::create([
                    'title' => $request->title,
                    'pub_type' => $request->pub_type,
                    'user_id' => auth()->id(),
                ]);
                GenreController::setBookGenres($book, $request->genre);

                Log::info('Created book with id: '.$book->id.' and title '.$book->title);
            } catch (Throwable $e) {
                report($e);
                dd($e);
            }
            return redirect('/books');
        } else {
            return redirect()->route('book.create');
        }
    }

    public function update(BookRequest $request,Book $book) {
        if ($request->validated()) {

            try {
                Log::info('Updating books data with id: '.$book->id.' and title '.$book->title);
                $book->update([
                    'title' => $request->title,
                    'pub_type' => $request->pub_type,
                ]);


                GenreController::updateBookGenres($book, $request->genre);
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
