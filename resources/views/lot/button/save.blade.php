<form action="{{route ('lots.update', $lot)}}" method="post"
@csrf
@method('PUT')
    <button class="btn btn-sm btn-btn btn-warning btn-lg btn-block" type="submit">Save</button>
</form>
