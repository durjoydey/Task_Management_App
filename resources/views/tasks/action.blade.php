<a href="{{ url("/tasks/$row->id/edit") }}" class="btn btn-info btn-sm">Edit</a>
<form action="{{ url("/tasks/$row->id") }}" method="POST"
    onsubmit="return confirm('Do you really want to delete the task?');">
    @csrf
    @method("delete")
    <input type="submit" name="" value="Delete" class="btn btn-danger btn-sm">
</form>
