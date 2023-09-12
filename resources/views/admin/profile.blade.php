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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                 Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>  


  @endsection
</x-admin-master>