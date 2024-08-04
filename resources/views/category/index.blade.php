@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form id="form1" action="{{route('category/bulk')}}" method="post">
                            @csrf
                            <div class="card-header">
                                <a href="{{route('category.create')}}" class="btn btn-primary">Add</a>
                                @include("confirm")
                                <a id="bulk" class="btn btn-primary" data-bs-toggle="modal"
                                   data-bs-target="#confirmModal">Delete selected</a>
                                <input class="btn btn-danger" type="reset" value="Deselect all">
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Parent id</th>
                                        <th>Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox" id="checkboxes"
                                                       name="checkboxes[]"
                                                       value="{{$category->id}} @checked(in_array($category->id, old('checkboxes', [])))">
                                            </td>
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                <a href="{{ route('category.show', $category->id) }}">{{ $category->title }}</a>
                                            </td>
                                            <td>{{ $category->parent_id }}</td>
                                            <td><a href="{{route('category.edit', $category->id)}}"
                                                   class="btn btn-primary">Update</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
