<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     */
    public function index(): View
    {
        $users = User::all();

        $books_counts = [];

        foreach ($users as $user) {
            $books_counts[] = Book::where('user_id', $user->id)->count();
        }

        $books_counts = array_reverse($books_counts);
        return view('user.index', compact('users'), compact('books_counts'));
    }
    public function create() {

        return view('user.create');
    }

    public function store(Request $request) {
        $data = request()->validate([
            'name' => 'string',
            'password' => 'string'
        ]);

        $book = User::create([
            'name' => $request->name,
            'password' => $request->password,
        ]);

        return redirect()->route('user.index');
    }
}
