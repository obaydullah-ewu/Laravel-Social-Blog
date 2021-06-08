@extends('layouts.app')

@section('content')
<br>
    <div class="container " style="width: 700px; height: 200px; border: " >
        <div class="row" style="border-block-color: red">
            <div class="col-md-6">
                <table cellspacing="500">
                    <tr>
                        <th>Name:</th>
                        <td><small>{{$user->name}}</small> </td>
                        
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td><small>{{$user->email}}</small></td>
                    </tr>
                    <tr>
                        <th>City: </th>
                        <td><small>{{$user->city}}</small></td>
                    </tr>
                    <tr>
                        <th>Country: </th>
                        <td><small> {{ $user->country}}</small></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <img style="width: 200px; height: 200px;" src="/1sapp/public/storage/cover_images/{{$user->cover_image}}">
            </div>
        </div>
        
    </div> <br>
    
    
    <style>
        .wrap
        {
            padding-top: 30px;
        }
    
        .glyphicon
        {
            margin-bottom: 10px;
            margin-right: 10px;
        }
    
        small
        {
            display: block;
            color: #888;
        }
    
        .well
        {
            border: 1px solid blue;
        }
    </style>
    
    <div class="container ">
        @foreach($posts as $post)
            @if($user->id == $post->user_id)
            
            <div class="card-deck" style="width: 600px; margin-left: 18%;      
            margin-right: 18%;
            width: auto;">
                <div class="card">
                  <img style="width: 300px; height: 230px;" class="card-img-top" src="/1sapp/public/storage/cover_images/{{$post->cover_image}}" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">{{$post->title}}</h5>
                    <p class="card-text">{{$post->body}}</p>
                  </div>
                  <div class="card-footer">
                    <?php $LikeCount = 0; ?>
                    @foreach($likes as $like)
                        @if($post->id == $like->post_id)
                            <?php $LikeCount++; ?>
                        @endif
                    @endforeach
                    <button class="btn btn-primary">Like(<?php echo $LikeCount; ?>)</button>
                    <?php $ccount = 0; ?>
                                    @foreach($comments as $comment)
                                        @if($post->id == $comment->post_id)
                                            <?php $ccount++; ?>        
                                        @endif
                                    @endforeach
                    <button class="btn btn-secondary">Comment(<?php echo $ccount; ?>)</button>
                  </div>
                  <div class="card-footer">
                    <small class="text-muted">Posted on {{$post->created_at}}</small>
                  </div>
                </div>
            </div>
            <br>
            @endif
        @endforeach
    </div>
    
    
@endsection