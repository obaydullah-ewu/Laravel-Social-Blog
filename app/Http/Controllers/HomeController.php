<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  
use App\Models\Like;
use App\Models\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $likes = Like::all();
        $comments = Comment::all();
        return view('home')->with('posts', $user->posts)->with('user', $user)->with('likes', $likes)->with('comments', $comments);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('dashboardhome.edit')->with('user', $user);
    }
}
