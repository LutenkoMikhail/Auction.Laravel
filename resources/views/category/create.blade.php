@extends('master')
@section('title','Create Category')
@section('content')
    <div class="caption">
        <h3 class="text-center"> {{ __ ('Create Category') }} </h3>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route ('categories.store')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="" minlength="5" maxlength="30"
                                   placeholder="name" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>
                    <hr>

                    <div class="text-center">
                        @include('category.button.create')
                        @include('category.button.back')
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
