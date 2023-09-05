<x-admin-master>
@section('content')
@if (session('message'))
  <div class="alert alert-success">
    <b>
  {{ session('message') }}
 
</b>&#10004;</div>
@endif  

<h1>Create Post</h1>


<form action="{{route('post.create')}}" method="post" enctype="multipart/form-data">
@csrf
<x-input type="text" name="title" placeholder="Title" label="Title" :error="$errors->first('title')"/><br>
<x-input type="text" name="content" placeholder="Content" label="Content" :error="$errors->first('content')"/><br>
<x-input type="file" name="image" placeholder="image" label="Image" :error="$errors->first('image')"/> <br>
<button type="submit" class=" btn btn-primary">Submit</button>




</form>


@endsection

</x-admin-master>