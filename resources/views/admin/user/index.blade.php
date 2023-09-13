<x-admin-master>

  @section('content')

  <h1>All Users</h1><br>
  @if(session('user-deleted'))
<span class="alert alert-danger">{{session('user-deleted')}}</span>
  @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">user Tables </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Avatar</th>
              <th>Username</th>
              <th>Name</th>
              <th>Registered On</th>
              <th>Updated On</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Avatar</th>
              <th>Username</th>
              <th>Name</th>
              <th>Registered On</th>
              <th>Updated On</th>
              <th>Action</th>

            </tr>
          </tfoot>
          
     

   @foreach($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td> <img src="{{$user->avatar}}" alt="Avatar" height="60px">
              </td>
            <td>{{$user->username}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
            <td><form action="{{route('admin.user.delete',$user->id)}}" method="post">
              @csrf 
              @method('DELETE')
              <button class="btn btn-danger">Delete</button>
              
            </form></td>
          </tr>
        @endforeach


     
        </table>
   
      </div>
    </div>
  </div>



  @endsection

  @section('scripts')
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
  @endsection
</x-admin-master>