@extends('layouts.app')

@section('content')
<a href="/1sapp/public/posts" class="btn btn-default" style="background-color: royalblue"><i class="fas fa-hand-point-left"> Go Back</i></a><br>
    <h1 style="background-color: blue; text-align:center; width: 400px; margin:auto;" >Edit Post</h1>
    
    <form style="font-weight: bold;" action="{{route('posts.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        {{ method_field('PUT') }}
        <label for="title">Title</label><br>
        <input type="text" id="title" name="title" value="{{$post->title}}" class="form-control"><br>
        <label  for="body">Body</label><br>
        <textarea type="textarea" id="body" name="body" value="" class="form-control">
        {{$post->body}}</textarea><br><br>
        <label for="cover_image">Image</label>
        <input type="file" id="cover_image" name="cover_image" class="form-control">
        <input type="hidden" name="_token" value="{{csrf_token() }}" class="form-control">
        <br>
        <input type="submit" value="Submit" class="btn btn-primary form-control">
      </form>
@endsection

