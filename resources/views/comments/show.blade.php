@if(count($comments)>0)
    @foreach($comments as $comment)
        <small>{{$comment->commenttext}}</small>
    @endforeach
@else
    <p>No comments found</p>
@endif

<h2>show</h2>