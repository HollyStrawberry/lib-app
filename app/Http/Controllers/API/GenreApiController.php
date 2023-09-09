<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreCollection;
use App\Models\Genre;

class GenreApiController extends Controller
{
    public function index()
    {
        return new GenreCollection(Genre::paginate());
    }

}
