@extends('layouts.app')

@section('content')
<a href="/1sapp/public/posts" class="btn btn-default" style="background-color: royalblue"><i class="fas fa-hand-point-left"> Go Back</i></a><br>
<h1 style="background-color: blue; text-align:center; width: 400px; margin:auto;" class="mb-2">Edit Comment</h1>
    
<form action="{{route('comments.update', $comment->id)}}" method="POST">
    {{ method_field('PUT') }}
    <textarea class="form-control" name="commenttext" id="commenttext" cols="30" rows="5" required autofocus>
        {{$comment->commenttext}} </textarea>

    <input type="hidden" name="_token" value="{{csrf_token() }}" class="form-control">
    <br>
    <input type="submit" value="Submit" class="btn btn-primary form-control">
</form>
@endsection