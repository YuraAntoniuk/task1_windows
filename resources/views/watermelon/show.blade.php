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
                        <div class="card-header d-flex p-3">
                            <div class="mr-3">
                                <a href="{{route('watermelon.edit', $watermelon->id)}}" class="btn btn-primary">Updated</a>
                            </div>
                            <form action="{{ route('watermelon.destroy', $watermelon->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Видалити">
                            </form>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $watermelon->id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $watermelon->title }}</td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>{{ $watermelon->description }}</td>
                                </tr>
                                <tr>
                                    <td>Sort</td>
                                    <td>{{ $watermelon->sort }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>{{ $watermelon->price }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{ $watermelon->country }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
