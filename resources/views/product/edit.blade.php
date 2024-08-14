@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update product</h1>
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
                <form action="{{route('product.update', $product->id)}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group w-25">
                        <input type="text" name="title" value="{{$product->title ?? old('title')}}" class="form-control" placeholder="Name"><br>
                        <input type="text" name="description" value="{{$product->description ?? old('description')}}" class="form-control" placeholder="Description"><br>
                        <input type="text" name="price" value="{{$product->price ?? old('price')}}" class="form-control" placeholder="Price"><br>
                        <select id="category_id" name="category_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="{{$product->category_id}}" selected>Choose category</option>
                            @foreach ($categories as $category)
                                @if($category->parent_id === null){
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                }@endif
                            @endforeach
                        </select><br>
                        <select id="subcategory_id" name="subcategory_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="" selected disabled hidden>Choose subcategory</option>
                        </select><br>
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </form>
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
                url: "/product/subcategory",
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