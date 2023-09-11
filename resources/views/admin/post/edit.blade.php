<x-admin-master>
  @section('content')
  @if (session('message'))
    <div class="alert alert-success">
      <b>
    {{ session('message') }}
   
  </b>&#10004;</div>
  @endif  
  
  <h1>Edit Post</h1>
  
  


  <form method="POST" action="{{ route('admin.post.update',$post->id) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')

  <label for="title">Title</label>
  <input type="text" name="title" value="{{$post->title}}" class="form form-control">
  <label for="Content">Content</label>
  <input type="text" name="content" value="{{$post->content}}" class="form form-control">
 
   <br> <img src="{{$post->image}}" alt="" height="120px" width="120px"><br>
    <label for="title">Image</label>
    <input type="file" name="image" class="form form-control"><br>
    <button type="submit" class="btn btn-success">Update</button>
  </form>
  
  
  @endsection
  
  </x-admin-master>