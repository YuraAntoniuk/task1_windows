@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Weather</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <form action="{{url('/weather/city')}}" method="post">
                        @csrf
                        <input id="city" type="text" class="form-control" name="city"><br>
                        <select id="lang" name="lang" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            @foreach ($languages as $language)
                                <option value="{{$language}}">{{$language}}</option>
                            @endforeach
                        </select><br>
                        <input type="submit" class="btn btn-primary" value="submit">
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
