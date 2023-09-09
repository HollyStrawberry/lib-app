<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserApiController extends Controller
{
    public function index()
    {
        return new UserCollection(User::paginate());
    }

    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    public function update(UserRequest $request)
    {
        $user = auth()->user();
        $user->fill($request->except(['user_id']));
        $user->save();
        return response()->json($user);
    }

}
