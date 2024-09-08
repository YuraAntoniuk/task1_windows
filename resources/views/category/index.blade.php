@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
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
                        <form action="{{route('category/bulk')}}" method="post">
                            @csrf
                            <div class="card-header">
                                <a href="{{route('category.create')}}" class="btn btn-primary">Add</a>
                                <input class="btn btn-danger" value="Delete selected" data-bs-toggle="modal"
                                       data-bs-target="#confirmModal">
                                @include("confirm")
                                <input class="btn btn-warning" type="button" onclick="selectAll()" value="Select all">
                                <input class="btn btn-danger" type="reset" value="Deselect all">
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table id="table" class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th onclick="sortTable(1)">ID</th>
                                        <th onclick="sortTable(2)">Name</th>
                                        <th>Parent id</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox" id="checkboxes"
                                                       name="checkboxes[]"
                                                       value="{{$category->id}} @checked(in_array($category->id, old('checkboxes', [])))">
                                            </td>
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                <a href="{{ route('category.show', $category->id) }}">{{ $category->title }}</a>
                                            </td>
                                            <td>{{ $category->parent_id }}</td>
                                            <td><a href="{{route('category.edit', $category->id)}}"
                                                   class="btn btn-primary">Update</a>
                                            </td>
                                            <td>
                                                <form id="delete_form" action="{{route('category.destroy', $category->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="submit" class="btn btn-danger" value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$categories->links()}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $("#confirm").on('click', function (e){
                e.preventDefault()
                let values = []
                $("#checkboxes:checked").each(function (){
                    values.push($(this).val())
                })
                console.log(values)
                $.ajax({
                    url: "/category/bulk",
                    type: 'POST',
                    data: {
                        arrayData: values,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        console.log('Success:', response);
                        window.location.href = '{{url()->current()}}';
                    },
                    error: function(xhr) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                })

            })
        </script>
        <script type="text/javascript" src="/scripts/scripts.js"></script>
        <script>
            function selectAll(){
                $(".form-check-input").prop("checked", true);
            }
        </script>
    </section>
    <!-- /.content -->
@endsection
