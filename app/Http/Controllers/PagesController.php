<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

class PagesController extends Controller
{
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $comments = Comment::all();
        $users = User::all();
        return view('posts.index')->with('posts', $posts)->with('comments', $comments)->with('users', $users);
    }

    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }

    public function services(){
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }

    public function timeline($id){
        $user = User::find($id);
        $posts = Post::all();
        $comments = Comment::all();
        $likes = Like::all();
        return view('user.timeline')->with('posts', $posts)->with('comments', $comments)->with('user', $user)->with('likes', $likes);
    }
}
