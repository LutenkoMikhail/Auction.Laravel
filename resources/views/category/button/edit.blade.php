<form method="get" action="{{ route('categories.edit', $category->id) }}">
    @csrf
    @method('GET')
    <button class="btn btn-sm btn-btn btn-warning btn-lg btn-block" type="submit">Edit</button>
</form>
