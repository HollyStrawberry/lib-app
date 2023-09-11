<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     */

    public function index()
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

    public function edit(Request $request, $id) {

        $user = User::find($id);

        return view('user.edit',compact('user'));
    }

    public function store(Request $request) {
       // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_admin' => [],
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'isAdmin' => $request->is_admin != null ? 1 : 0,
        ]);

        event(new Registered($user));

        return redirect()->route('user.index');
    }
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'string'
        ]);

       $user = User::find($id);
       $user->update([
            'name' => $request->name
        ]);

        if ($request->password)
        {

            $request->validate([
                'password' => 'required|confirmed',
            ]);

            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('user.index');
    }

    public function destroy($id) {
        $user = User::find($id);
        if ($user->books->all() == [])
            $user->delete();
        return redirect('/users');
    }

}
