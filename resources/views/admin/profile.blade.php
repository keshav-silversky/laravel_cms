<x-admin-master>

  @section('content')


  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

      


            <div class="card">
         
              <h1>User Profile  </h1>
              @if(session('message'))
              <div class="alert alert-success">
                <b>
              {{ session('message') }}
             
            </b>&#10004;</div>
              @endif
                <div class="card-body">
                    <form method="POST" action={{route('admin.profile.update',$user)}} enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        {{-- Image --}}
                            
                        <div class="row mb-3">
                          <div class="col-md-6">
                            <img src="{{$user->avatar}}" alt="Profile Pic" class="img-profile rounded-circle border border-info mb-4" height="120px" width="120px">
                            <input type="file" name="avatar" class="form-control">
                          </div>
                      </div>
                        <div class="row mb-3">
                          <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                          <div class="col-md-6">
                              <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{$user->username}}">

                              @error('username')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                          </div>
                      </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}"  autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                        </div>

                 @can('update', $user)
                 <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-success">
                         Update
                        </button>
                    </div>
                </div>
                @else  <button  class="btn btn-success" disabled>
                    Update
                   </button>
                 @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  

<br>
<h1>User Role</h1>

@if(session('attached'))
<span class="alert alert-success">{{session('attached')}}</span>
@elseif(session('already_attached'))
<span class="alert alert-warning">{{session('already_attached')}}</span>
@endif
@if(session('detached'))
<span class="alert alert-success">{{session('detached')}}</span>

@endif
     
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Roles </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive  text-center">
      
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Option</th>
              <th>Id</th>
              <th>Name</th>
              <th>Slug</th>
              <th colspan="2">Action</th>

      
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>Option</th>
                <th>Id</th>
                <th>Name</th>
                <th>Slug</th>
                <th colspan="2">Action</th>
            </tr>
          </tfoot>
          
     
          @foreach($roles as $role)
          <tr>
            <td><input type="checkbox" 
                @if($user->UserHasRole($role->name) ) 
                checked  
                @endif
                ></td>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>{{$role->slug}}</td>
            <td>
              @if($user->UserHasRole($role->name) == false)
                <form method="post" action={{route('user.role.attach',$user)}}>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="role" value="{{$role->id}}">
                <button class="btn btn-success">Attach</button>
            </form>
            @else
            <button class="btn btn-success" disabled>Attach</button>
            @endif
            </td>
            <td>
              @if($user->UserHasRole($role->name)==true)
              <form method="post" action={{route('user.role.detach',$user)}}>
                @csrf
                @method('DELETE')
                <input type="hidden" name="role" value={{$role->id}}>
              <button type="submit" class="btn btn-danger">Detach</button>
            </form>
            @else
            <button type="submit" class="btn btn-danger" disabled>Detach</button>
            @endif

          </td>
            

            </tr>
          @endforeach
   


     
        </table>
   
      </div>
    </div>
  </div>
  @endsection
</x-admin-master>