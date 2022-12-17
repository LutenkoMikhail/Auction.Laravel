<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="caption">
            <p>{{$category->name}}</p>
            <h6>
                Lots:
                @if ($category->canDeleteCategory())
                    No
                @else
                    Yes
                @endif
            </h6>
            <div class="center">
                @include('category.button.show')
                @include('category.button.edit')
                @if ($category->canDeleteCategory())
                    @include('category.button.delete')
                @endif
            </div>

        </div>
    </div>
</div>
