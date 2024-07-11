@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add watermelon</h1>
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
                <form action="{{route('watermelon.store')}}" method="post">
                    @csrf
                    <div class="form-group w-25">
                        <input type="text" name="title" class="form-control" placeholder="Name"><br>
                        <input type="text" name="description" class="form-control" placeholder="Description"><br>
                        <input type="text" name="sort" class="form-control" placeholder="Sort"><br>
                        <input type="text" name="price" class="form-control" placeholder="Price"><br>
                        <input type="text" name="country" class="form-control" placeholder="Country"><br>
                        <input type="submit" class="btn btn-primary" value="Додати">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
