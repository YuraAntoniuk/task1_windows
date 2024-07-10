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
                        <div class="card-header">
                            <a href="{{route('watermelon.create')}}" class="btn btn-primary">Додати</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Country</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($watermelons as $watermelon)
                                    <tr>
                                        <td>{{ $watermelon->id }}</td>
                                        <td><a href="{{ route('watermelon.show', $watermelon->id) }}">{{ $watermelon->title }}</a></td>
                                        <td>{{ $watermelon->description }}</td>
                                        <td>{{ $watermelon->sort }}</td>
                                        <td>{{ $watermelon->price }}</td>
                                        <td>{{ $watermelon->country }}</td>
                                    </tr>
                                @endforeach
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
