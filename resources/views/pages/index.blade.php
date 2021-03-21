@extends('layouts.app')

@section('content')
<style>
    #blocksize{
        height: 500px;
        weight: 500;
    }
</style>
    <div id="blocksize" class="jumbotron text-center" style="background-color: blue">
        <h1>{{$title}}</h1>
        <p>This is a blog application"</p>
        <p><a href="/1sapp/public/posts" class="btn btn-success btn-lg" role="button">Click to See Blog Post</a></p>
    </div>

@endsection

