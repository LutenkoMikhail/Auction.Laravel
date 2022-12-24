@extends('master')
@section('title','All lots ')
@section('content')

    @include('lot.search',$categories)

    <div class="starter-template">
        @if(!$lots->isEmpty())
            <h1>All lots entries [{{$allLots}}]</h1>
            <div class="viewRender">
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
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.category').select2();
        });

        $('body').on('click', '#saveData', function (e) {
            e.preventDefault();
            var category = $('.category').val();

            $.ajax({
                url: "{{ route('search') }}",
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category: category,
                },

                success: function (data) {
                    $('.viewRender').html(data.html);
                },
                cache: false,

                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });

    </script>

@endsection
