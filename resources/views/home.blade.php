<x-master>
  
@section('content')
  
@foreach ($posts as $post)

<div class="card mb-4">
  <img class="card-img-top" src="{{$post->image}}" alt="Card image cap">
  <div class="card-body">
    <h2 class="card-title">{{$post->title}}</h2>
    <p class="card-text">{{$post->content}}</p>
    <a href={{route('post' , $post->id)}} class="btn btn-primary">Read More &rarr;</a>
  </div>
  <div class="card-footer text-muted">
    Posted on {{$post->created_at->diffforHumans()}}
    {{-- <a href="#">Start Bootstrap</a> --}}
  </div>
</div>
@endforeach

@endsection

</x-master>

