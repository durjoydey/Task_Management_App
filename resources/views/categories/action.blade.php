<a href="{{ url("/categories/$c->id/edit") }}" class="btn btn-info btn-sm">Edit</a>
<form action="{{ url("/categories/$c->id") }}" method="POST"
    onsubmit="return confirm('Do you really want to delete the category?');">
    @csrf
    @method("delete")
    <input type="submit" name="" value="Delete" class="btn btn-danger btn-sm">
</form>
