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

                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Назва">
                    </div>
                    <div class="form-group">
                        <input type="text" name="description" class="form-control" placeholder="Опис">
                    </div>
                    <div class="form-group">
                        <input type="text" name="sort" class="form-control" placeholder="Сорт">
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" class="form-control" placeholder="Ціна">
                    </div>
                    <div class="form-group">
                        <input type="text" name="country" class="form-control" placeholder="Країна">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Додати">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
