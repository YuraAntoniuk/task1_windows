@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="d-flex justify-content-center">
                    <h1 class="m-0">Facebook API</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="card-header">
            <a href="{{route('facebook.postCreate')}}" class="btn btn-primary">Add</a>
            <a href="{{route('facebook.photoCreate')}}" class="btn btn-warning">Upload photos</a>
        </div><br>
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            @foreach($posts as $post)
            <div class="card bg-success text-white text-center mb-4">
                <div class="card-body">
                    <h5 class="card-title">Post {{$post->id}}</h5>
                    @if(isset($post->message))
                        <p>{{$post->message}}</p>
                    @endif
                </div>
                <form id="delete_form" action="{{route('facebook.deletePost', $post->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
            </div>
            @endforeach
        </div>
    </div>
@endsection
