@extends('layouts.app')
@section('content')
<section class="content-header">
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Categories</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Blank Page</li>
      </ol>
    </div>
  </div>
</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Title</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <a href="{{ url('/tasks/create') }}" class="btn btn-info float-right" >Create New Task</a>
    
    <table class="table" id="myTable">
      <thead>
        <tr>
          <td>SL</td>
          <td>Title</td>
          <td>Deadline</td>
          <td>Category</td>
          <td>Status</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody></tbody>
      {{-- @php
          $sl=1;
      @endphp
      @forelse ($tasks as $t)
          <tr>
            <td>{{ $sl++ }}</td>
            <td>{{ $t->title }}</td>
            <td>{{ $t->deadline }}</td>
            <td>{{ $t->category->name }}</td>
            <td>{{ App\Enums\StatusType::getDescription($t->status);  }}</td>
            <td>
              <a href="{{ url("/tasks/$t->id/edit") }}">Edit</a>
              <form action="{{ url("/tasks/$t->id") }}" method="POST" onsubmit="return confirm('Do you really want to delete the category?');">
                @csrf
                @method("delete")
                <input type="submit" name="" value="Delete" class="btn btn-danger btn-sm">
              </form>
            </td>
          </tr>
      @empty
          <tr >
            <td colspan="3">No Taks Found</td>
          </tr>
      @endforelse --}}
    </table>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    Footer
  </div>
  <!-- /.card-footer-->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
@endsection


@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/tasks/list',
            columns: [
                {
                    data: 'DT_RowIndex',
                    name: 'id'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'deadline',
                    name: 'deadline'
                },
                {
                    data: 'category.name',
                    name: 'category.id'
                },
                {
                    data: 'status_name',
                    name: 'status'
                },
                {data: 'action', orderable: false, searchable: false}
                
            ]
        });
    });

</script>
@endpush