@extends('layouts.app')

@section('content')
<div class="container">
     <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
        @csrf 
        @method('PUT')
        <h1>Edit Profile</h1>
         <div class="col-md-6">
            Title
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="title" value="{{$user->profile->title}}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        </div>
     

     <div class="row">
         Description
         <input type="text" name="description" value="{{$user->profile->description}}">
     </div>

     <div class="row">
         URL
         <input type="text" name="url" value="{{$user->profile->url}}">
     </div>


     <div class="row">Image
        <input type="file" name="image">
    </div>
     


    <div class="row">
         <button class="btn">
            EDIT 
        </button>
    </div>
        </form>
         @if($errors->any())
        <div class="row collapse">
            <ul class="alert-box warning radius">
                @foreach($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
        @endif
</div>
@endsection
