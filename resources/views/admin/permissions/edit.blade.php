<x-admin-master>
  @section('content')

  <h1>Edit Permission</h1>

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
    <form method="post" action="{{route('permission.update',$permission->id)}}">
      @csrf
      @method('PUT')
      <input type="text" name="name" value="{{$permission->name}}" class="form-control w-50"><br>
      @error('name')
          <div class="alert alert-danger">{{$message}}</div>
      @enderror
      <button type="submit" class="btn btn-primary w-50">Update</button>

    </form>
  </div>
</div>
</div>
<div>
  <a href="{{route('permissions.index')}}"><button class="btn btn-primary">View Permissions</button></a>
  </div>
@endsection
</x-admin-master>