@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update watermelon </h1>
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
                <form action="{{route('watermelon.update', $watermelon->id)}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group w-25">
                        <input type="text" name="title" value="{{$watermelon->title ?? old('title')}}" class="form-control" placeholder="Name"><br>
                        <input type="text" name="description" value="{{$watermelon->description ?? old('description')}}" class="form-control" placeholder="Description"><br>
                        <input type="text" name="sort" value="{{$watermelon->sort ?? old('sort')}}" class="form-control" placeholder="Sort"><br>
                        <input type="text" name="price" value="{{$watermelon->price ?? old('price')}}" class="form-control" placeholder="Price"><br>
                        <input type="text" name="country" value="{{$watermelon->country ?? old('country')}}" class="form-control" placeholder="Country"><br>
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
