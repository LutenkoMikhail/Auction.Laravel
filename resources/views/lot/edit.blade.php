@extends('master')
@section('title','Edit Lot')
@section('content')
    <div class="caption">
        <h3 class="text-center"> {{ __ ('Edit Lot') }} </h3>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{route ('lots.update', $lot)}}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ $lot->name }}" minlength="5" maxlength="50"
                                   placeholder="name" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="description"
                               class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-6">
                            <input id="description" type="text"
                                   class="form-control @error('description') is-invalid @enderror"
                                   name="description" value="{{ $lot->description }}" minlength="5" maxlength="100"
                                   placeholder="description" required autocomplete="description">
                            @error('description')
                            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selectcategories"
                               class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                        <select id="selectcategories" name="categories[ ]" multiple="multiple" size="8" required>
                            @foreach($categories as $category)
                                <option value={{$category->id}} >{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('selectcategories')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror

                    <div class="text-center">
                        @include('lot.button.save')
                        @include('lot.button.back')
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
