


<link rel="stylesheet" href="{{asset('css/app.css')}}">
<label for="{{$name}}"><b>{{$label}}</b></label>
<input type="{{$type}}" name="{{$name}}" placeholder="{{$placeholder}}" value="{{old($name)}}" class="form-control">
<span style="color:red">
  @if($error) 
  {{$error}}
@endif
</span> 