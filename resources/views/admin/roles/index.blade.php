<x-admin-master>

  @section('content')
  
  <h1>Roles</h1><br>
  
  <div class="row">
  
  
    <div class="col-sm-6">
     
      @if(session('created'))
      <div class="alert alert-success">{{session('created')}}</div>
      @endif
      @if(session('already_created'))
      <div class="alert alert-danger">{{session('already_created')}}</div>
      @endif
  

      <form method="post" action="{{route('role.create')}}">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Enter Role" class="form-control w-50 @error('name') is-invalid @enderror"><br>
        @error('name')
        <div class="alert alert-danger w-50">{{$message}}</div>
        @enderror
        <button type="submit" class="btn btn-primary w-50">Create</button>
      </form>
    </div>
  </div>
  <br>
  
 
    
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Roles </h6>
      </div>
      <div class="card-body">
        <div class="table-responsive  text-center">
        
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            @if(session('deleted'))
            <div class="alert alert-danger">{{session('deleted')}}</div>
            @endif
            <thead>
              <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Action</th>
  
        
              </tr>
            </thead>
            <tfoot>
              <tr>
              
                  <th>Id</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Action</th>
              </tr>
            </tfoot>
            

            @foreach($roles as $role)
            <tr>
              <td>{{$role->id}}</td>
              <td><a href="{{route('role.edit',$role->id)}}">{{$role->name}}</a></td>
              <td>{{$role->slug}}</td>
              <td>
                <form method="post" action="{{route('role.destroy',$role)}}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </td>

            </tr>
         @endforeach
  
  
       
          </table>
     
        </div>
      </div>
    </div>
  
    
  
  
  
  
  @endsection
  
  </x-admin-master>