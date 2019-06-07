@extends('layouts/app')

@section('content')
        <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ $post->caption }}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                         <img src="/storage/{{$post->img}}" alt="{{$post->caption}}" width="300px" height="300px" title="{{$post->caption}}">
                                    </div>
                                    <div class="col-4">
                                    <img src="/storage/{{$post->user->profile->img}}" alt="{{$post->user->profile->Name}}" width="50px" height="50px" class="rounded-circle">
                                        <h6 class="pl-1">{{$post->user->username}}</h6> <a href="#"> Follow</a>
                                        <hr>
                                        <p class="pt-2">{{$post->caption}}</p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
