@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
   		<div class="row">
   			<img src="{{ $post->user->profile->profileImage()}}" style="max-width:50px">
   		</div>
        <div class="font-weight-bold">
            <a href="profile/{{$post->user->id}}"><h3>{{$post->user->username}}</h3></a>
        </div>
        <div><h4>{{$post->category}}</h4></div>
       <div class="row">
           <img src="/storage/{{$post->image}}" style="max-width:70px">
       </div>
       <a href="post/{{$post->id}}/edit">Edit</a>
   </div>

</div>
@endsection
