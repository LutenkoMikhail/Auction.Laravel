<div class="container">
    <br/>
    <div class="col-md-4">
        <form method="POST" action="{{ route('search') }}">
            <div class="form-group">
                <label>Category:</label>
                <select class="category form-control" name="category[]" multiple>
                    @foreach($categories as $category)
                        <option value={{$category->id}} >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" id="saveData">Search</button>
            </div>
            <div id="result">
            </div>
        </form>
    </div>
</div>


