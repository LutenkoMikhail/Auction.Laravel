<form method="post" action="{{ route('categories.create') }}">
    @csrf
    @method('POST')
    <button class="btn btn-sm btn-btn btn-warning btn-lg btn-block" type="submit">Create Category</button>
</form>
