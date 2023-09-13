<x-admin-master>
  @section('content')

  <h1>Edit Role</h1>

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
<div>
<a href="{{route('roles.index')}}"><button class="btn btn-primary">View Roles</button></a>
</div>
  @endsection
</x-admin-master>