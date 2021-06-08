<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'commenttext' => 'required',
        ]);

        $comment = new Comment([
            'post_id' => $request->get('post_id'),
            'user_id' => auth()->user()->id,
            'commenttext' => $request->get('commenttext'),
            
        ]);
        
        $comment->save();
        
        // return redirect('posts')->with('success', 'Comment Created Successfully');
        return Redirect::back()->with('success', 'Comment Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'commenttext' => 'required',
        ]);
        $comment = Comment::find($id);
        $comment->commenttext = $request->get('commenttext');
        $comment->save();
        return redirect('/posts')->with('success', 'Comment Updated !!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        if(auth()->user()->id !== $comment->user_id){
            return redirect('/posts')->with('warning', 'Unauthorized Page');
        }

        $comment->delete();
        // return redirect('posts')->with('warning', 'Deleted Comment Successfully');
        return Redirect::back()->with('warning', 'Deleted Comment Successfully');
    }
}
