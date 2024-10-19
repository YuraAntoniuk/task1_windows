@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="d-flex justify-content-center">
                    <h1 class="m-0">Create Post</h1>
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

                <form action="{{route('facebook.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group w-25 mx-auto">
                        <input type="text" id="message" name="message" class="form-control" placeholder="Message" ><br>
                        <input type="file" name="images[]" class="form-control" placeholder="Choose file"><br>
                        <input type="submit" class="btn btn-primary" value="Додати">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
