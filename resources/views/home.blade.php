@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user->username}}</div>
                <a href="api/p/create/">Add new Product</a>
                <div class="card-body">
                    
                        <div class="alert alert-success" role="alert">
                            {{$user->profile->title}}
                        </div>
                        <div>{{$user->profile->description}}</div>
                    <div><a href="#">{{$user->profile->url}}</a></div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($user->posts as $post)
            <div class="row">
                <img src="/storage/"{{$post->image}} class="w-100">
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
