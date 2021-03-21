@extends('layouts.app')

@section('content')

{{-- Create form --}}

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box;}

    /* Button used to open the contact form - fixed at the bottom of the page */
    .open-button {
    background-color: rgb(46, 43, 226);
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    opacity: 0.8;
    /* position: fixed; */
    bottom: 500px;
    right: 28px;
    width: 280px;
}

/* The popup form - hidden by default */
    .form-popup {
        display: none;
        /* position: fixed; */
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
    max-width: 300px;
    padding: 10px;
    background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
    background-color: #ddd;
    outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom:10px;
    opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
    background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
    opacity: 1;
    }
</style>


<br>


<button class="open-button btn btn-primary" onclick="openForm()"><i class="fa fa-plus" aria-hidden="true"> Create New Post</i></button>

<div class="form-popup" id="myForm">
  <form action="{{route('posts.store')}}" class="form-container" enctype="multipart/form-data"  method="POST">

    <label for="title"><b>Title</b></label><br>
    <input type="text" id="title" name="title" value="" class="form-control"><br>
    <label for="body"><b>Body</b></label><br>
    <textarea type="textarea" id="body" name="body" value="" class="form-control"></textarea><br>
    <label for="cover_image"><b>Image</b></label>
    <input type="file" name="file"> <br>
    <input type="hidden" name="_token" value="{{csrf_token() }}" class="form-control">
    {{-- <input type="submit" value="Submit" class="form-control btn btn-primary"> --}}

    <button type="submit" class="btn">Submit</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>

</body>
</html>

{{-- End create form --}}


    {{-- <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">   
        @csrf
        <label for="title">Title</label><br>
        <input type="text" id="title" name="title" value="" class="form-control"><br>
        <label for="body">Body</label><br>
        <textarea type="textarea" id="body" name="body" value="" class="form-control"></textarea><br><br>
        <label for="cover_image">Image</label>
        <input type="file" name="file" class="dropzone" id="dropzone" placeholder="Drag or drop here">
        <input type="hidden" name="_token" value="{{csrf_token() }}" class="form-control">
        <br>
        <input type="submit" value="Submit" class="form-control btn btn-primary">
    </form>    --}}
<br><br><br>
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-block" style="background-color: green">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{session('success')}}</strong>
        </div>
    @endif
    @if($message = Session::get('warning'))
        <div class="alert alert-danger alert-block" style="background-color: red">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <strong>{{session('warning')}}</strong>
        </div>
    @endif
    <div class="row">

        <div class="col-md-8">
            @if(count($posts)>0)
                @foreach($posts as $post)
                        <div class="row pb-1" >
                            <div class="col-md-6 col-sm-6">
                                <img style="width: 100%; height: 230px;" src="/1sapp/public/storage/cover_images/{{$post->cover_image}}">
                            </div>
                            <div class="col-md-6 col-sm-6" >
                                <table class="table table-bordered" style="background-color: rgb(231, 231, 245)">
                                    <tr>
                                        <th>
                                            <h3><a style="color: rgb(3, 17, 3)" href="/1sapp/public/posts/{{$post->id}}">{{$post->title}}</a></h3>
                                            <p class="ArticleBody" style="font-weight:normal">{{ substr(strip_tags($post->body), 0, 90) }}
                                                {{ strlen(strip_tags($post->body)) > 50 ? "..." : "" }} <a href="/1sapp/public/posts/{{$post->id}}" style="color: black; font-weight:bold">Read more</a>
                                            </p>
                                            <small style="color:rgb(13, 84, 177)">Written on {{$post->created_at}} by </small> <br>
                                            <img style="width: 20%; height: 50px;" src="/1sapp/public/storage/cover_images/{{$post->user->cover_image}}"> {{$post->user->name}}
                                            
                                            <a class="" href="/1sapp/public/posts/{{$post->id}}"><i class="far fa-comment"> Comment here</i></a>
                                        </th>
                                    </tr>
                                </table>
                            </div>     
                        </div>  
                @endforeach
                <br>
                {{ $posts->links('pagination::bootstrap-4') }}
            @else 
                <p> No posts found </p>
            @endif
        </div>
        <div class="col-md-4">
            <h2>People</h2>
            <form action="{{ route('searchpeople')}}" method="GET">
                <input type="text" name="searchpeople" required/>
                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"> Search People</i></button>
            </form>
            @foreach($users as $user)
            <img style="width: 20%; height: 50px;" src="/1sapp/public/storage/cover_images/{{$user->cover_image}}"><a href="{{route('timeline', $user->id)}}"><h5>{{$user->name}}</h5></a>  <br> 
            @endforeach

            
        </div>
            
    </div>
@endsection

