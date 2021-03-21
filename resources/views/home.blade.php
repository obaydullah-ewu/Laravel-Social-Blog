@extends('layouts.app')

@section('content')
@if($message = Session::get('success'))
    <div class="alert alert-success alert-block" style="background-color: green">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{session('success')}}</strong>
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ __('You are logged in!') }} --}}

                    {{-- Start Show Profile Part --}}
                    <h2><button class="btn btn-primary">Your Profile</button> </h2>
                    <style>
                        th{
                            color: green;
                        }
                        th,td{
                            padding: 15px; 
                        }    
                    </style> 
                    <table border="2">
                        <tr>
                            <th>Name:</th>
                            <td><small>{{$user->name}}</small> </td>
                            <td rowspan="4"><img style="width: 200px; height: 200px;" src="/1sapp/public/storage/cover_images/{{$user->cover_image}}"></td>
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
                            

                    <hr>
                    {{-- End Profile Part --}}
                     
                    <a href="/1sapp/public/posts/create" class="btn btn-primary">Create Post</a>
                    
                    <h3>Your Blog Posts</h3>
                    @if(count($posts) > 0 )
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th>Total Comments</th>
                                <th>Total Likes</th>
                                <th style="text-align: center" colspan="2">Action</th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td><a style="color: rgb(11, 65, 165)" href="/1sapp/public/posts/{{$post->id}}">{{$post->title}}</a></td>
                                    <?php $LikeCount = 0; ?>
                                    @foreach($likes as $like)
                                        @if($post->id == $like->post_id)
                                            <?php $LikeCount++; ?>
                                        @endif
                                    @endforeach



                                    <?php $ccount = 0; ?>
                                    @foreach($comments as $comment)
                                        @if($post->id == $comment->post_id)
                                            <?php $ccount++; ?>        
                                        @endif
                                    @endforeach
                                    <td style="text-align: center"><?php echo $ccount; ?></td>

                                    <td style="text-align: center"><?php echo $LikeCount; ?></td>
                                    <td><a href="/1sapp/public/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                    <td><form action="{{route('posts.destroy', $post->id)}}" method="POST">
                                        {{method_field('DELETE')}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" name="submit" value="Delete" class="btn btn-danger">
                                    </form></td>
                                    
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
