<form method="get" action="{{ route('categories.show', $category->id) }}">
    @csrf
    @method('GET')
    <button class="btn btn-sm btn btn-success btn-lg btn-block" type="submit">Show</button>
</form>
