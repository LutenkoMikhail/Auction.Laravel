@extends('master')
@section('title','All lots ')
@section('content')
    <div class="starter-template">

        @if(!$lots->isEmpty())
            <h1>All lots entries [{{$allLots}}]</h1>
            <div class="row">
                @foreach($lots as $lot)
                    @include('lot.card',$lot)
                @endforeach
            </div>
            {{$lots->links()}}
    </div>
    @else
        <h1>There are no lots</h1>
    @endif

@endsection
