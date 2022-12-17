<form method="post" action="{{ route('lots.destroy', $lot->id) }}">
    @csrf
    @method('DELETE')
    <button class="btn-sm btn btn-danger btn-lg btn-block" type="submit">Delete</button>
</form>
