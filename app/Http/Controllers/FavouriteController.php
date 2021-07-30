<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        $question->favourites()->attach(auth()->id());
        return back();
    }
    public function destroy(Question $question)
    {
        $question->favourites()->detach(auth()->id());
        return back();
    }
}
