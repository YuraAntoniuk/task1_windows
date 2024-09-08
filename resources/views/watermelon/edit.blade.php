@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update user </h1>
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
                <form action="{{route('watermelon.update', $user['data']['id'])}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group w-25">
                        <input type="text" name="name" value="{{$user['data']['first_name']}}" class="form-control" placeholder="First name"><br>
                        <input type="text" name="job" value="{{$user['data']['last_name']}}" class="form-control" placeholder="Last name"><br>
                        <input type="text" name="job" value="{{$user['data']['email']}}" class="form-control" placeholder="Email"><br>
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
