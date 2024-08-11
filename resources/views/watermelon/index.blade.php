@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Watermelon</h1>
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
                        <form action="{{route('watermelon/bulk')}}" method="post">
                            @csrf
                            <div class="card-header">
                                <a href="{{route('watermelon.create')}}" class="btn btn-primary">Add</a>
                                <input class="btn btn-danger" value="Delete selected" data-bs-toggle="modal"
                                       data-bs-target="#confirmModal">
                                @include("confirm")
                                <input class="btn btn-danger" type="reset" value="Deselect all">
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Sort</th>
                                        <th>Price</th>
                                        <th>Country</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($watermelons as $watermelon)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox" id="checkboxes"
                                                       name="checkboxes[]"
                                                       value="{{$watermelon->id}}" @checked(in_array($watermelon->id, old('checkboxes', [])))>
                                            </td>
                                            <td>{{ $watermelon->id }}</td>
                                            <td>
                                                <a href="{{ route('watermelon.show', $watermelon->id) }}">{{ $watermelon->title }}</a>
                                            </td>
                                            <td>{{ $watermelon->description }}</td>
                                            <td>{{ $watermelon->sort }}</td>
                                            <td>{{ $watermelon->price }}</td>
                                            <td>{{ $watermelon->country }}</td>
                                            @foreach($categories as $category)
                                                @if($watermelon->category_id === $category->id)
                                                    <td>{{ $category->title }}</td>
                                                @endif
                                                @if($watermelon->subcategory_id === $category->id)
                                                        <td>{{ $category->title }}</td>
                                                    @endif
                                            @endforeach
                                            <td><a href="{{route('watermelon.edit', $watermelon->id)}}"
                                                   class="btn btn-primary">Update</a></td>
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
