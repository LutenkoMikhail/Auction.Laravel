@extends('master')
@section('title','View Lot')
@section('content')

    <div class="text-center">
        <h1>
            Show Lot
        </h1>
    </div>

    <div class="thumbnail">
        <div class="caption">
            <div class="text-center">
                <h1>
                    {{$lot->name}}
                </h1>
            </div>
            <hr>
            <h3>
                Description:
                <p>{{$lot->description}}</p>
            </h3>
            @include('lot.categories')
            <hr>
        </div>
        <div class="center">
            @include('lot.button.back')
            @include('lot.button.edit')
            @include('lot.button.delete')
        </div>
    </div>

@endsection
