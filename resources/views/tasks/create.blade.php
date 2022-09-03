@extends('layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tasks</h1>
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
            <div class="card card-primary col-md-6">
                <div class="card-header">
                    <h3 class="card-title">Create New Task</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ url("/tasks") }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                id="" placeholder="Enter task Name" value="{{ old("title") }}">
                            @error('title')
                            <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                                id="" placeholder="Enter task description" value="{{ old("description") }}">
                            @error('description')
                            <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">-- Please Select-- </option>
                                @foreach ($category_list as $c)
                                    <option value="{{ $c->id }}" {{ old('category_id')== $c->id ? 'selected' :'' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">-- Please Select Status-- </option>
                                @foreach ($status_list as $key => $value)
                                    <option value="{{ $key }}" {{ old('status')== strval($key) ? 'selected' :'' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('status')
                            <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Deadline</label>
                            <input type="date" name="deadline" class="form-control @error('deadline') is-invalid @enderror"
                                id="" placeholder="Enter deadline" value="{{ old("deadline") }}">
                            @error('deadline')
                            <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif --}}
                        <button type="submit" class="btn btn-primary">Create </button>
                    </div>
                </form>
            </div>

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