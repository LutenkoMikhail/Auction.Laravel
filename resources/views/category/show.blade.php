@extends('master')
@section('title','View Category')
@section('content')

    <div class="text-center">
        <h1>
            Show Category
        </h1>
    </div>

    <div class="thumbnail">
        <div class="caption">
            <div class="text-center">
                <h1>
                    {{$category->name}}
                </h1>
            </div>
            <hr>
            <h6>
                Lots:
                @if ($category->canDeleteCategory())
                    No
                @else
                    Yes
                @endif
            </h6>
            <hr>
        </div>
        <div class="center">
            @include('category.button.back')
            @include('category.button.edit')
            @if ($category->canDeleteCategory())
                @include('category.button.delete')
            @endif
        </div>
    </div>

@endsection
