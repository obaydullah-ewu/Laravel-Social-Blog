@extends('layouts.app')

@section('content')
<style>
    .image {
    margin-right: 20px;
    margin-left: 20px;
    position: relative;
    overflow: hidden;
    
}
</style>
<div class="mt-3" >
    <form action="{{ route('searchpeople')}}" method="GET">
        <input type="text" name="searchpeople" required/>
        <button type="submit" name="submit" class="btn btn-secondary"><i class="fas fa-search"> Search People</i></button>
    </form>
    <div class="" style="display: flex; flex-wrap: wrap;">

        @foreach($users as $user)
        
        <a href="{{route('timeline', $user->id)}}"><img style="width: 100px; height: 100px;" src="/1sapp/public/storage/cover_images/{{$user->cover_image}}"></a>
        <a href="{{route('timeline', $user->id)}}"><h5>{{$user->name}}</h5>&nbsp;&nbsp;&nbsp;&nbsp;</a>
        @endforeach
        
    </div>
        
</div>

@endsection
