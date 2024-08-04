@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Weather in {{$city}}</h1>
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
                    <h3>Main: {{$weather['main']}}</h3>
                    <h3>Description: {{$weather['main']['description']}}</h3>
                    <h3>Temperature: {{$weather['main']['temp']}}</h3>
                    <h3>Feels like: {{$weather['main']['feels_like']}}</h3>
                    <h3>Pressure: {{$weather['main']['pressure']}}</h3>
                    <h3>Humidity: {{$weather['main']['humidity']}}%</h3>
                    <h3>Visibility: {{$weather['visibility']}}</h3>
                    <h3>Wind speed: {{$weather['wind']['speed']}}</h3>
                    <h3>Clouds: {{$weather['clouds']['all']}}</h3>
                    <h3>Time of data calculation: {{$weather['dt']}}</h3>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
