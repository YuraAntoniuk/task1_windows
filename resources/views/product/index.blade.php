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
                                            @foreach($categories as $category)
                                                @if($product->category_id === $category->id)
                                                    <td>{{ $category->title }}</td>
                                                @endif
                                                @if($product->subcategory_id === $category->id)
                                                        <td>{{ $category->title }}</td>
                                                    @endif
                                            @endforeach
                                            <td><a href="{{route('product.edit', $product->id)}}"
                                                   class="btn btn-primary">Update</a></td>
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

        <script>

            // JavaScript program to illustrate
            // Table sort for both columns and
            // both directions
            function sortTable(n) {
                let table;
                table = document.getElementById("table");
                var i, x, y, count = 0;
                var switching = true;

                // Order is set as ascending
                var direction = "ascending";

                // Run loop until no switching is needed
                while (switching) {
                    switching = false;
                    var rows = table.rows;

                    //Loop to go through all rows
                    for (i = 1; i < (rows.length - 1); i++) {
                        var Switch = false;

                        // Fetch 2 elements that need to be compared
                        x = rows[i].getElementsByTagName("TD")[n];
                        y = rows[i + 1].getElementsByTagName("TD")[n];

                        // Check the direction of order
                        if (direction === "ascending") {

                            // Check if 2 rows need to be switched
                            if (x.innerHTML.toLowerCase() >
                                y.innerHTML.toLowerCase()) {

                                // If yes, mark Switch as needed
                                // and break loop
                                Switch = true;
                                break;
                            }
                        } else if (direction === "descending") {

                            // Check direction
                            if (x.innerHTML.toLowerCase() <
                                y.innerHTML.toLowerCase()) {

                                // If yes, mark Switch as needed
                                // and break loop
                                Switch = true;
                                break;
                            }
                        }
                    }
                    if (Switch) {

                        // Function to switch rows and mark
                        // switch as completed
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;

                        // Increase count for each switch
                        count++;
                    } else {

                        // Run while loop again for descending order
                        if (count === 0 && direction === "ascending") {
                            direction = "descending";
                            switching = true;
                        }
                    }
                }
            }
        </script>
    </section>

    <!-- /.content -->
@endsection
