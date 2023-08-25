<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * Show a list of all of the application's genres.
     */
    public function index(): View
    {
        return view('layouts.main');
    }
}
