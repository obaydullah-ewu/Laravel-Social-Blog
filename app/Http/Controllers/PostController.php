<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Post; 
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
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
        //return Post::all();
        //return Post::where('title', 'Post Two')->get();
        //$posts = DB::select('SELECT * FROM posts');
        // $posts = Post::orderBy('title', 'desc')->take(1)->get();
        //$posts = Post::orderBy('title', 'desc')->get();

        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $comments = Comment::all();
        $users = User::all();
        return view('posts.index')->with('posts', $posts)->with('comments', $comments)->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('file')){
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'_'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post([
            'title' => $request->get('title'),
            'body' => $request->get('body'),
        ]);
        $post->cover_image = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->save();
        
        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $post = Post::find($id);
        $comments = Comment::all();
        $likes = Like::all();
        return view('posts.show')->with('post', $post)->with('comments', $comments)->with('likes', $likes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('warning', 'Unauthorized Page');
        }
        return view('posts.edit', compact('post'));
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
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle file upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'_'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;  
        }
        $post->save();
        return redirect('/posts')->with('success', 'Post Updated !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('warning', 'Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('posts')->with('warning', 'Deleted Post Succesfully !!!');
    }
    
    public function search(Request $request){
        $search = $request->input('search');

        $posts = Post::query()->where('title', 'LIKE', "%{$search}%")->get();

        return view('posts.search', compact('posts'));
    }

    public function like(Request $request){

        $like = new Like([
            'post_id' => $request->get('post_id'),
            'user_id' => auth()->user()->id,
        ]);
        
        $likeuseridcheck =Like::where('post_id', '=' ,  $request->get('post_id'))
                            ->where('user_id', '=' , auth()->user()->id)
                            ->first();
        
        if($likeuseridcheck === null){
            $like->save();
            // return redirect('posts')->with('success', 'You like the post successfully');
            return Redirect::back()->with('success', 'You like the post successfully');
        }
        else{
            $likeuseridcheck =Like::where('post_id', '=' ,  $request->get('post_id'))
                            ->where('user_id', '=' , auth()->user()->id)
                            ->get();
            foreach($likeuseridcheck as $liked){
                $liked->delete();
                // return redirect('posts')->with('warning', 'You Unlike the Post successfully');
                return Redirect::back()->with('warning', 'You Unlike the Post successfully');
            }   
        }   
    }
}
