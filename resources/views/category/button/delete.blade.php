<form method="post" action="{{ route('categories.destroy', $category->id) }}">
    @csrf
    @method('DELETE')
    <button class="btn-sm btn btn-danger btn-lg btn-block" type="submit">Delete</button>
</form>
