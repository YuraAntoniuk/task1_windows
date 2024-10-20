@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update category </h1>
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
                <form action="{{route('category.update', $category->id)}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group w-25">
                        <input type="text" name="title" value="{{$category->title ?? old('title')}}" class="form-control" placeholder="Name"><br>
                        <input type="text" name="parent_id" value="{{$category->parent_id ?? old('parent_id')}}" class="form-control" placeholder="Parent_id"><br>
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
