@extends('layouts.app')

@section('title', $user->profile->Name . ' | ')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 pl-9">
        <img src="/storage/{{$user->profile->img}}" class="rounded-circle" alt="{{$user->profile->Name}}" height="200px" width="200px">
        </div>
        <div class="col-9 pt-4">
            <div class="d-flex justify-content-between align-bottom">
                <div class="d-flex justify-content-between">
                    <h2 class="pr-2">{{$user->profile->Name}}</h2>
                    <follow-button user_id={{$user->id}}></follow-button>
                </div>
                @can('update', $user->profile)
                    <a href="/p">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="/u/{{$user->id}}/edit">Edit Profile</a>
            @endcan

            <div class="d-flex">
            <div class="p-2"><strong>{{$user->posts->count()}}</strong> posts</div>
                <div class="p-2"><strong>234</strong> followers</div>
                <div class="p-2"><strong>134</strong> likes</div>
            </div>
            <div class="pt-4 font-weight-bold">
                {{$user->profile->Name}}
            </div>
            <div>{{$user->profile->description}}</div>
            <div><a href="#">{{$user->profile->url ?? 'N/A'}}</a></div>
        </div>
    </div>

    <div class="row pt-5">
        @if ($user->posts)
            @foreach ($user->posts as $post)
            <div class="col-4 pb-4">
            <a href="/p/{{$post->id}}"><img src="/storage/{{$post->img}}" alt="{{$post->caption}}" class="w-100 h-100" title="{{$post->caption}}"></a>
            </div>
            @endforeach
        @endif
    </div>

</div>
@endsection
