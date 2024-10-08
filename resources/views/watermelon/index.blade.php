@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
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
                        <form action="{{route('watermelon/bulk')}}" method="post">
                            @csrf
                            <div class="card-header">
                                <a href="{{route('watermelon.create')}}" class="btn btn-primary">Add</a>
                                <input class="btn btn-danger" value="Delete selected" data-bs-toggle="modal"
                                       data-bs-target="#confirmModal">
                                @include("confirm")
                                <input class="btn btn-danger" type="reset" value="Deselect all">
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table id="table" class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>ID</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users['data'] as $user)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox" id="checkboxes"
                                                       name="checkboxes[]"
                                                       value="{{$user['id']}} @checked(in_array($user['id'], old('checkboxes', [])))">
                                            </td>
                                            <td>{{ $user['id'] }}</td>
                                            <td>
                                                <a href="{{ route('watermelon.show', $user['id']) }}">{{ $user['first_name'] }}</a>
                                            </td>
                                            <td>{{ $user['last_name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td><a href="{{route('watermelon.edit', $user['id'])}}"
                                                   class="btn btn-primary">Update</a>
                                            </td>
                                            <td>
                                                <form id="delete_form" action="{{route('watermelon.destroy', $user['id'])}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->

    </section>

    <!-- /.content -->
@endsection
