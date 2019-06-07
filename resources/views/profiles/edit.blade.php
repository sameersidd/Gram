@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 pl-9">
        <img src="/storage/{{$user->profile->img}}" class="rounded-circle" alt="" height="200px" width="200px">
        </div>
        <div class="col-9 pt-4">
            <div class="d-flex justify-content-between align-bottom">
                <h2>{{$user->profile->name}}</h2>
                <p>Edit Profile</p>
            </div>
            <form action="/u/{{$user->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                        <div class="form-group-row">
                            <label for="Name" class="col-md-4 col-form-label">Name:</label>
                            <input type="text" name="Name" id="Name" value="{{ old('Name') ?? $user->profile->Name}}" class="form-control @if ($errors->first('Name'))is-invalid @endif">
                            @if ($errors->first('Name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Name') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group-row">
                                <label for="description" class="col-md-4 col-form-label">Description:</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control @if ($errors->first('description'))is-invalid @endif">{{ old('Name') ?? $user->profile->description}}</textarea>
                                @if ($errors->first('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                        </div>
                        <div class="form-group-row">
                                <label for="url" class="col-md-4 col-form-label">URL:</label>
                                <input type="text" name="url" id="url" value="{{ old('url') ?? $user->profile->url}}" class="form-control @if ($errors->first('url'))is-invalid @endif">
                                @if ($errors->first('url'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('url') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group-row pt-2">
                                    <label for="img" class="col-md-4 col-form-label">Profile Image:</label>
                                    <input type="file" name="img" id="image" class="form-control-file @if ($errors->first('img'))is-invalid @endif">
                                    @if ($errors->first('img'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('img') }}</strong>
                                            </span>
                                    @endif
                                </div>
                        <div class="form-group row mb-0">
                                <div class="col-md-6 pt-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Change') }}
                                    </button>
                                </div>
                            </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
