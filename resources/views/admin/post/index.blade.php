<x-admin-master>

  @section('content')

  <h1>All Post</h1>
  @if(session('message'))
  <div class="alert alert-danger"> &times;  {{session('message')}}  </div>
  @elseif(session('update'))
  <div class="alert alert-success"> &#10004;  {{session('update')}}  </div>
  @endif

  @if(session('postvalidator'))
  <div class="alert alert-danger"> &times;  {{session('postvalidator')}}  </div>
  @endif
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Post Tables </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Owner Name</th>
              <th>Image</th>
              <th>Title</th>
              <th>Content</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Owner Name</th>
              <th>Image</th>
              <th>Title</th>
              <th>Content</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th>Action</th>
            </tr>
          </tfoot>
          
     
          @foreach($posts as $post)
   
          <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->user->name}}</td>
            <td> <img src="{{$post->image}}" alt="" height="40px" width="40px"></td> 
            <td>{{$post->title}}</td>
            <td>{{$post->content}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
            <th>
         
              
                <a href="{{route("post.edit",$post->id)}}"><button type="submit" class="btn btn-warning">Edit</button></a>
              
                 {{-- <form action={{route("post.edit",$post->id)}} method="get"> --}}
                {{-- @csrf  --}}
          {{-- <button type="submit" class="btn btn-warning">Edit</button>
                 </form> --}}
              &nbsp;
              <form action={{route("admin.post.destroy",$post->id)}} method="post">
                @csrf
                @method('delete')
              <button type="submit" class="btn btn-danger">Delete</button>  
            </form>

          
          
          </th>

          </tr>
         @endforeach

     
        </table>
        {{$posts->links()}}
      </div>
    </div>
  </div>
<div>



  @endsection



  @section('scripts')
  {{-- <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script> --}}
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
  @endsection
</x-admin-master>
