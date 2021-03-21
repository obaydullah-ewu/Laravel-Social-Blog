@extends('layouts.app')

@section('content')
    <br>
    <form action="{{ route('search')}}" method="GET">
        <input type="text" name="search" required/>
        <button type="submit" class="btn btn-secondary"><i class="fas fa-search"> Search Post</i></button>
    </form>
    
    @if($posts->isNotEmpty())
        @foreach ($posts as $post)
            <div class="">
                <h3><a href="/1sapp/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
                <img style="width: 30%" src="/1sapp/public/storage/cover_images/{{$post->cover_image}}">
            </div>
        @endforeach
    @else 
        <div>
            <h2>No posts found</h2>
        </div>
    @endif
@endsection