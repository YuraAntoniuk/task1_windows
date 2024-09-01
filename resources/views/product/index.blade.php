@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Product</h1>
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
                        <form action="{{route('product/bulk')}}" method="post">
                            @csrf
                            <div class="card-header">
                                <a href="{{route('product.create')}}" class="btn btn-primary">Add</a>
                                <input class="btn btn-danger" value="Delete selected" data-bs-toggle="modal"
                                       data-bs-target="#confirmModal">
                                @include("confirm")
                                <input class="btn btn-danger" type="reset" value="Deselect all">
                                <input class="btn btn-warning" type="button" onclick="selectAll()" value="Select all">
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table id="table" class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th onclick="sortTable(1)">ID</th>
                                        <th onclick="sortTable(2)">Name</th>
                                        <th onclick="sortTable(3)">Description</th>
                                        <th onclick="sortTable(4)">Price</th>
                                        <th onclick="sortTable(5)">Category</th>
                                        <th onclick="sortTable(6)">Subcategory</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox" id="checkboxes"
                                                       name="checkboxes[]"
                                                       value="{{$product->id}}" @checked(in_array($product->id, old('checkboxes', [])))>
                                            </td>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                <a href="{{ route('product.show', $product->id) }}">{{ $product->title }}</a>
                                            </td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                <a href="{{route('category/item', $product->category_id)}}">{{ $product->category->title }}</a>
                                            </td>
                                            <td>
                                                <a href="{{route('category/item', $product->subcategory_id)}}">{{ $product->subcategory->title }}</a>
                                            </td>
                                            <td><a href="{{route('product.edit', $product->id)}}"
                                                   class="btn btn-primary">Update</a></td>
                                            <td>
                                                <form id="delete_form" action="{{route('product.destroy', $product->id)}}" method="post">
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
                    url: "/product/bulk",
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
        <script>
            function sortTable(n) {
                var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                table = document.getElementById("table");
                switching = true;
                dir = "asc";
                while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        x = rows[i].getElementsByTagName("TD")[n];
                        y = rows[i + 1].getElementsByTagName("TD")[n];

                        let xContent = (isNaN(x.innerHTML)) ? (x.innerHTML.toLowerCase() === '-') ? 0 : x.innerHTML.toLowerCase() : parseFloat(x.innerHTML);
                        var yContent = (isNaN(y.innerHTML)) ? (y.innerHTML.toLowerCase() === '-') ? 0 : y.innerHTML.toLowerCase() : parseFloat(y.innerHTML);
                        if (dir === "asc") {
                            if (xContent > yContent) {
                                shouldSwitch = true;
                                break;
                            }
                        } else if (dir === "desc") {
                            if (xContent < yContent) {
                                shouldSwitch = true;
                                break;
                            }
                        }
                    }
                    if (shouldSwitch) {
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                        switchcount ++;
                    } else {
                        if (switchcount === 0 && dir === "asc") {
                            dir = "desc";
                            switching = true;
                        }
                    }
                }
            }
        </script>

        <script>
            function selectAll(){
                $(".form-check-input").prop("checked", true);
            }
        </script>
    </section>

    <!-- /.content -->
@endsection
