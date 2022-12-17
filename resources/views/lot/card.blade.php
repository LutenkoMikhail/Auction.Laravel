<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="caption">
            <p>{{$lot->name}}</p>
            <h6>
                Description:
                <p>{{$lot->description}}</p>
            </h6>
            @include('lot.categories')
            <div class="center">
                @include('lot.button.show')
                @include('lot.button.edit')
                @include('lot.button.delete')
            </div>

        </div>
    </div>
</div>
