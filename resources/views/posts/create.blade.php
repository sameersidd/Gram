@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Post') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/p" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group-row">
                                <label for="img" class="col-md-4 col-form-label text-md-right">File:</label>
                                <input type="file" name="img" id="image" class="form-control-sm @if ($errors->first('img'))is-invalid @endif">
                                @if ($errors->first('img'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('img') }}</strong>
                                        </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="caption" class="col-md-4 col-form-label text-md-right">{{ __('Post Caption:') }}</label>

                                <div class="col-md-6">
                                    <input id="postname" type="text" class="form-control @if ($errors->first('caption'))is-invalid @endif " name="caption" @if ($errors->first('caption')) value = "{{ old('caption')}}" @endif autofocus>
                                    @if ($errors->first('caption'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('caption') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
