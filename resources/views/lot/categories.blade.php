<h6>
    <hr>
    Categories:
    @if (!$lot->checkCategories())
        No
    @else
        {{$lot->checkCategories()}}
        <br>
        <div class="center">
            @foreach($lot->categories as $category)
                <a href="{{route('categories.show',$category->id)}}"
                   class="btn btn-sm btn-primary btn-lg btn-block">{{ ($category->name)}}</a>
            @endforeach
        </div>
    @endif
</h6>
