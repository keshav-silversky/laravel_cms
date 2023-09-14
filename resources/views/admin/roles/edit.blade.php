<x-admin-master>
  @section('content')

  <h1>Edit Role</h1>

  <div class="row">
  <div class="col 3">
@if(session('updated'))
  <div class="alert alert-success">
{{session('updated')}}
  </div>
  @endif
  @if(session('not_update'))
  <div class="alert alert-warning">
{{session('not_update')}}
  </div>
  @endif

  <div class="form-group">
    <form method="post" action="{{route('role.update',$role->id)}}">

      @csrf
      @method('PUT')
      <input type="text" name="name" value="{{$role->name}}" class="form-control w-50"><br>
      @error('name')
          <div class="alert alert-danger">{{$message}}</div>
      @enderror
      <button type="submit" class="btn btn-primary w-50">Update</button>

    </form>
  </div>
</div>
</div>

@if(session('attached'))
  <div class="alert alert-success">
{{session('attached')}}
  </div>
  @endif
  @if(session('detached'))
  <div class="alert alert-danger">
{{session('detached')}}
  </div>
  @endif
<div class="row">
@if($permissions->isNotEmpty())
<div class="col 3">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Permissions </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive  text-center">
      
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    
          <thead>
            <tr>
              <th>Options</th>
              <th>Id</th>
              <th>Name</th>
              <th>Slug</th>
              <th colspan="2">Action</th>

      
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Options</th>
                <th>Id</th>
                <th>Name</th>
                <th>Slug</th>
                <th colspan="2">Action</th>
            </tr>
          </tfoot>

          @foreach($permissions as $permission)
          <tr>
            <td>
              <input 
              type="checkbox"
              @foreach($role->permissions as $role_permission)
              @if($role_permission->slug == $permission->slug)
              checked
              @endif
              @endforeach
              >
              </td>
            <td>{{$permission->id}}</td>
            <td>{{$permission->name}}</td>
            <td>{{$permission->slug}}</td>
            <td>

            
                @if(!$role->permissions->contains($permission))
                <form method="post" action="{{route('role.permission.attach',$role->id)}}">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="permission" value="{{$permission->id}}">
                  <button type="submit" class="btn btn-primary">Attach
                </button>
                </form>
                @else
                <button  class="btn btn-primary " disabled title="Already Attached">Attach
                  @endif
              </td>

            
            <td>
              @if($role->permissions->contains($permission))
              <form method="post" action="{{route('role.permission.detach',$role->id)}}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="permission" value="{{$permission->id}}">
                <button type="submit" class="btn btn-danger">Detach
              </button>
              </form>
              @else
              <button class="btn btn-danger " disabled>Detach
                @endif
            </td>

          </tr>
          @endforeach
        </table>
   
      </div>
    </div>
  </div>
</div>
@endif


</div>


<div>
<a href="{{route('roles.index')}}"><button class="btn btn-primary">View Roles</button></a>
</div>
  @endsection
</x-admin-master>