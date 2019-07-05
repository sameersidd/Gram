@extends('layouts/app')

@section('content')
        <div class="container">
                @foreach ($posts as $post)
                <div class="row justify-content-center">
                        <div class="col-6 offset-3">
                        <a href="/p/{{$post->id}}"></a><img src="/storage/{{$post->img}}" alt="{{$post->caption}}" width="300px" height="300px" title="{{$post->caption}}">
                           </div>
                </div>
                <div class="row justify-content-center">
                        <div class="col-md-6 offset-3">
                            <div class="card">
                                <div class="card-header">{{ $post->caption }}</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="pt-2">{{$post->caption}}</p>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="row d-flex justify-content-center">
                <div class="col-12">{{$posts->render()}}</div>
                </div>
        </div>
@endsection
