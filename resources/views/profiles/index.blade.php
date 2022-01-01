@extends('layouts.app')

@section('content')

<div class="row">
    <form action="{{route('post.search')}}" method="GET">
        <input type="text" name="qwery" placeholder="search for product" value="{{request()->input('qwery')}}">

    </form>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <img src="{{$user->profile->profileImage()}}" style="max-width:75px">
                </div>
                <div class="card-header">{{$user->username}}</div>
                <div class="row">Number OF Products {{$user->posts->count()}}</div>
                <div class="col-md-8">Followers{{$user->profile->followers->count()}}</div>
                <div class="col-md-8">Following{{$user->following->count()}}</div>
                <br>
                @can('update',$user->profile)
                <a href="/p/create">Add new Product</a>
                <br>
                <a href="/profile/{{$user->id}}/edit">Edit</a>
                @endcan
                <div class="card-body">
                    
                        <div class="row">
                            {{$user->profile->title}}
                        </div>
                        <div>{{$user->profile->description}}</div>
                    <div><a href="#">{{$user->profile->url}}</a></div>
                </div>
            </div>
            -----------------<br>
            <div class="row">
            @foreach($user->posts as $post)
            <div class="row">
                <a href="/p/{{$post->id}}">
                <img src="/storage/{{$post->image}}"class="w-100 h-100">
            </div>
        </a>
            ---------
            @endforeach
        </div>
        </div>
    </div>
</div>
@endsection
