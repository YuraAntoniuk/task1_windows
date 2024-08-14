@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add watermelon</h1>
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
                <form action="{{route('watermelon.store')}}" method="post">
                    @csrf
                    <div class="form-group w-25">
                        <input type="text" name="title" class="form-control" placeholder="Name"><br>
                        <input type="text" name="description" class="form-control" placeholder="Description"><br>
                        <input type="text" name="sort" class="form-control" placeholder="Sort"><br>
                        <input type="number" name="price" class="form-control" placeholder="Price"><br>
                        <input type="text" name="country" class="form-control" placeholder="Country"><br>
                        <select id="category_id" name="category_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="" selected disabled hidden>Choose category</option>
                            @foreach ($categories as $category)
                                @if($category->parent_id === null){
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                }@endif
                            @endforeach
                        </select><br>
                        <select id="subcategory_id" name="subcategory_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="" selected disabled hidden>Choose subcategory</option>
                        </select><br>
                        <input type="submit" class="btn btn-primary" value="Додати">
                    </div>
                </form>
                <div id="resultContainer"></div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $("#category_id").on("change", function (){
            $('#subcategory_id').empty()
            var data = $("#category_id").val()
            $.ajax({
                url: "/watermelon/subcategory",
                type: 'POST',
                data: {
                    data: data,
                    _token: '{{csrf_token()}}'
                },
                success: function (response){
                    response.subcategories.forEach(subcategories => $('#subcategory_id').append(`<option value="${subcategories.id}">${subcategories.title}</option>`))
                    console.log(response)
                },
                error: function(xhr) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
            })
        });
    </script>
    <!-- /.content -->
@endsection
