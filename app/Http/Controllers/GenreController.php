<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
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
    public function index(): View
    {
        $genres = Genre::all();

        return view('genre.index', compact('genres'));
    }

    public function create() {

        return view('genre.create');
    }

    public function store(Request $request) {
        $data = request()->validate([
            'name' => 'string'
        ]);

        $genre = Genre::create([
            'name' => $request->name,
        ]);

        return redirect()->route('genre.index');
    }
}
