@extends('master')
@section('title','All categories ')
@section('content')
    <div class="starter-template">

        @if(!$categories->isEmpty())
            <h1>All category entries [{{$allCategories}}]</h1>
            <div class="row">
                @foreach($categories as $category)
                    @include('category.card',$category)
                @endforeach
            </div>
            {{$categories->links()}}
    </div>
    @else
        <h1>There are no categories</h1>
    @endif

@endsection
