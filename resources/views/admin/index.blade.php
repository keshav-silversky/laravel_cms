<x-admin-master>

@section('content')

@if(auth()->user()->UserHasRole('Admin')) 
<h1>Admin Dashboard</h1>
@endif
@endsection


</x-admin-master>