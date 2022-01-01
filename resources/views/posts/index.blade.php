@extends('layouts.app')

@section('content')
<div class="container">
   @foreach($posts as $post)
   <div class="row">
        <div class="col-6 offset-3">
             <span class="font-weight-bold">
            <span class = "text-dark">{{$post->name}}</span>
             <a href="/p/{{$post->id}}"><img src="/storage/{{$post->image}}" style="max-width:70px"></a>
             </span>
        </div>
    </div>
       @endforeach   
</div>


@endsection
