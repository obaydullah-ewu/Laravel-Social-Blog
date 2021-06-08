@extends('layouts.app')

@section('content')
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block" style="background-color: green">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{session('success')}}</strong>
        </div>
    @endif

    @if($message = Session::get('warning'))
        <div class="alert alert-danger alert-block" style="background-color: red">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{session('warning')}}</strong>
        </div>
    @endif
    
    <a href="/1sapp/public/posts" class="btn btn-default" style="background-color: royalblue"><i class="fas fa-hand-point-left"> Go Back</i></a>
    <h1>{{$post->title}} </h1>
    <img style="width: 30%; height: 270px;" src="/1sapp/public/storage/cover_images/{{$post->cover_image}}">
    <br> <br>
    <div>
        {{$post->body}}
    <div>
    <hr>
    <h6 style="color: rgb(104, 78, 8); font-weight:bold;"><small>Written on {{$post->created_at}} by</small> {{$post->user->name}}</h6>
    <table>
        @if(!Auth::guest())
            @if(Auth::user()->id == $post->user_id)
            <hr>
            <tr>
                <th><a href="/1sapp/public/posts/{{$post->id}}/edit" class="btn btn-secondary">EDIT</a></th>
                <th><form action="{{route('posts.destroy', $post->id)}}" method="POST">
                        {{method_field('DELETE')}}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" name="submit" value="DELETE" class="btn btn-danger">
                    </form>
                </th>
            </tr>
            @endif
        @endif
    </table>

    {{-- Start Like/Unlike part --}}

    <form action="{{route('like')}}" method="get">
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="hidden" name="_token" value="{{csrf_token() }}" >

        <?php $LikeCount = 0; ?>
        @foreach($likes as $like)
            @if($post->id == $like->post_id)
                {{-- Liker id: {{$like->id}}
                User id: {{$like->user_id}} <br> --}}
                <?php $LikeCount++; ?>
            @endif
        @endforeach

        
        <hr>
        
        <?php $likeCheck = 0; ?>
        @foreach($likes as $like)
            @if($post->id == $like->post_id)
                @if(Auth::user()->id == $like->user_id)
                    <?php $likeCheck = 1 ?>
                    <button type="submit" class="btn btn-primary btn-md active"><i class="fas fa-thumbs-down"> Unlike (<?php echo $LikeCount; ?>)</i></button>
                    @break
                @endif
            @endif
        @endforeach
        <?php 
            if($likeCheck == 0)
            {?>
                <button type="submit" class="btn btn-primary btn-md "><i class="fas fa-thumbs-up"> Like (<?php echo $LikeCount; ?>)</i></button>
            <?php }
        
        ?>
        
    </form>
    <hr>

    {{-- End Like/Unlike part --}}

    {{-- Start Post Comment Part --}}

    <form action="{{route('comments.store')}}" method="POST">
        <div class="form-group">
            <textarea class="form-control" name="commenttext" id="commenttext" cols="30" rows="5" required autofocus>
            </textarea>
            <input type="hidden" name="post_id" value="{{ $post->id }}" />
        </div>
        <div class="form-group">
            <input type="hidden" name="_token" value="{{csrf_token() }}" class="form-control">
            <button type="submit" class="btn btn-success btn-lg btn-block"><i class="far fa-comment"> POST COMMENT</i></button>
        </div>
    </form>
    {{-- End Post Comment Part --}}

    
    {{-- Start Comment Show Part --}}

    <h3 style="text-align:center; color: blue; ">Comments</h3>
    
    @if(count($comments)>0)
        <?php $ccount = 0; ?>
        @foreach($comments as $comment)
            @if($post->id == $comment->post_id)
                <?php $ccount++; ?>
                <div class="container" style="background-color: rgb(147, 130, 223)">
                    <h4>{{$comment->commenttext}}</h4> <br>
                    <h6 style="color: rgb(104, 78, 8); font-weight:bold;"><small>Commented on {{$comment->created_at}} by</small> <br><img style="width: 50px; height: 50px;" src="/1sapp/public/storage/cover_images/{{$comment->user->cover_image}}"> {{$comment->user->name}} </h6><br>
                    @if(!Auth::guest())
                        @if(Auth::user()->id == $comment->user_id)
                        <table>
                            <tr>
                                <th><a href="/1sapp/public/comments/{{$comment->id}}/edit" class="btn btn-secondary">EDIT</a></th>
                                <th>
                                    <form action="{{route('comments.destroy', $comment->id)}}" method="POST">
                                        {{method_field('DELETE')}}
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="submit" name="submit" value="DELETE" class="btn btn-danger">
                                    </form>         
                                </th>
                            </tr>   
                        </table>
                                                 
                        @endif
                    @endif                    
                    <hr>
                </div>                
            @endif
        @endforeach
        <div class="container" style="background-color: cornsilk; color:rgb(147, 130, 223); text-align:center"><h2><?php echo "Total Comments: ".$ccount; ?></h2></div>
    @else
        <p>No comments found</p>
    @endif

    {{-- End Comment Show Part --}}
@endsection

