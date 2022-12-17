<form method="post" action="{{ route('lots.create') }}">
    @csrf
    @method('POST')
    <button class="btn btn-sm btn-btn btn-warning btn-lg btn-block" type="submit">Create Lot</button>
</form>
