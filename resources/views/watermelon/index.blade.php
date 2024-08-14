@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Watermelon</h1>
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
                                        <th onclick="sortTable(1)">ID</th>
                                        <th onclick="sortTable(2)">Name</th>
                                        <th onclick="sortTable(3)">Description</th>
                                        <th onclick="sortTable(4)">Sort</th>
                                        <th onclick="sortTable(5)">Price</th>
                                        <th onclick="sortTable(6)">Country</th>
                                        <th onclick="sortTable(7)">Category</th>
                                        <th onclick="sortTable(8)">Subcategory</th>
                                        <th>Update</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($watermelons as $watermelon)
                                        <tr>
                                            <td><input class="form-check-input" type="checkbox" id="checkboxes"
                                                       name="checkboxes[]"
                                                       value="{{$watermelon->id}}" @checked(in_array($watermelon->id, old('checkboxes', [])))>
                                            </td>
                                            <td>{{ $watermelon->id }}</td>
                                            <td>
                                                <a href="{{ route('watermelon.show', $watermelon->id) }}">{{ $watermelon->title }}</a>
                                            </td>
                                            <td>{{ $watermelon->description }}</td>
                                            <td>{{ $watermelon->sort }}</td>
                                            <td>{{ $watermelon->price }}</td>
                                            <td>{{ $watermelon->country }}</td>
                                            @foreach($categories as $category)
                                                @if($watermelon->category_id === $category->id)
                                                    <td>{{ $category->title }}</td>
                                                @endif
                                                @if($watermelon->subcategory_id === $category->id)
                                                        <td>{{ $category->title }}</td>
                                                    @endif
                                            @endforeach
                                            <td><a href="{{route('watermelon.edit', $watermelon->id)}}"
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
                        x = rows[i].getElementsByTagName("td")[n];
                        y = rows[i + 1].getElementsByTagName("td")[n];

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
