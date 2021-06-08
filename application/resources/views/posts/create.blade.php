{{-- @extends('layouts.app')

@section('content') --}}
    {{-- <h1 style="background-color: blue; text-align:center; width: 400px; margin:auto;">Create Post</h1>
    <form style="font-weight: bold" action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
        <label for="title">Title</label><br>
        <input type="text" id="title" name="title" value="" class="form-control"><br>
        <label for="body">Body</label><br>
        <textarea type="textarea" id="body" name="body" value="" class="form-control"></textarea><br><br>
        <label for="cover_image">Image</label>
        <input type="file" id="cover_image" name="file" class="form-control">
        <input type="hidden" name="_token" value="{{csrf_token() }}" class="form-control">
        <br>
        <input type="submit" value="Submit" class="form-control btn btn-primary">
      </form> --}}
{{-- @endsection; --}}

@extends('layouts.app')
    
@section('content')
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
       
    <form method="post" action="{{route('posts.store')}}" enctype="multipart/form-data" >
      @csrf
      <label for="title">Title</label><br>
        <input type="text" id="title" name="title" value="" class="form-control" placeholder="Type post title here"><br>
        <label for="body">Body</label><br>
        <textarea type="textarea" id="body" name="body" value="" class="form-control" placeholder="Type post body here"></textarea><br><br>
        <label for="cover_image">Image</label>
        <input type="file" id="dropzone" class="dropzone form-control" name="file" placeholder="Image drop here"><br>
        <input type="submit" value="Submit" class="form-control btn btn-primary">
  </form>   
@endsection
<script type="text/javascript">
  Dropzone.options.dropzone =
    {
      maxFilesize: 12,
      renameFile: function(file) {
          var dt = new Date();
          var time = dt.getTime();
          return time+file.name;
      },
      acceptedFiles: ".jpeg,.jpg,.png,.gif",
      addRemoveLinks: true,
      timeout: 50000,
      removedfile: function(file) 
      {
          var name = file.upload.filename;
          $.ajax({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              },
              type: 'POST',
              url: '{{ url("image/delete") }}',
              data: {filename: name},
              success: function (data){
                  console.log("File has been successfully removed!!");
              },
              error: function(e) {
                  console.log(e);
              }});
              var fileRef;
              return (fileRef = file.previewElement) != null ? 
              fileRef.parentNode.removeChild(file.previewElement) : void 0;
      },

      success: function(file, response) 
      {
          console.log(response);
      },
      error: function(file, response)
      {
          return false;
      }
  };
</script>