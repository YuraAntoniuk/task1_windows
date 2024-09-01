@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="d-flex justify-content-center">
                    <h1 class="m-0">Add category</h1>
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
                <form id="form" action="{{route('category.store')}}" method="post">
                    @csrf
                    <div class="form-group w-25 mx-auto">
                        <input id="title" type="text" name="title" class="form-control" placeholder="Title"><br>
                        <select id="category" name="parent_id" class="form-select form-select-sm" aria-label=".form-select-sm example">
                            <option value="" selected disabled hidden>Choose parent category</option>
                            @foreach ($categories as $category)
                                @if($category->parent_id === null){
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                }@endif
                            @endforeach
                        </select><br>
                        <div id="add_sub" class="d-grid gap-2 d-md-block">
                            <button type="button" onclick="addSub()" class="btn btn-success">Додати підкатегорію</button>
                            <button type="button" onclick="submitData()" class="btn btn-success">Підтвердити</button><br>
                        </div>
                    </div><br>
                </form>
                <div id="errorContainer" class="form-group w-25 mx-auto d-grid gap-2 d-block"></div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            let containerCount = 0;
            function generateUniqueId(){
                containerCount++;
                return containerCount;
            }
            function addSub(){
                const div = document.getElementById("form");
                const wrapper = document.createElement("div");
                const field = document.createElement("input");
                const deleteButton = document.createElement("button");
                const uniqueId = generateUniqueId();

                //створення контейнера
                wrapper.setAttribute("class", "form-group w-25 p-2 mx-auto input-group mb-2")
                wrapper.setAttribute("id", uniqueId);

                //створення поля введення
                field.setAttribute("type", "text");
                field.setAttribute("class", "form-control");
                field.setAttribute("placeholder","Назва підкатегорії");
                field.setAttribute("area-describedby", "button-addon1");
                field.setAttribute("name", "title");

                //створення кнопки видалення
                deleteButton.setAttribute("id", "button-addon1");
                deleteButton.setAttribute("type", "button");
                deleteButton.setAttribute("class", "btn btn-outline-secondary");
                deleteButton.innerHTML= "-";
                deleteButton.onclick = function (){
                    deleteContainer(uniqueId);
                }

                wrapper.appendChild(deleteButton);
                wrapper.appendChild(field);
                div.appendChild(wrapper);
            }
            function deleteContainer(containerId){
                const container = document.getElementById(containerId);
                if (container) {
                    container.remove();
                }
            }
            function submitData() {
                const data = [];
                const inputs = document.querySelectorAll('input.form-control');
                inputs.forEach(item =>{
                    data.push({ title: item.value })
                })
                const body = JSON.stringify(data)
                console.log(body);
                fetch('/category', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{csrf_token()}}'
                    },
                    body: body
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success){
                            console.log('Form submitted successfully:', data);
                            window.location.href = '{{route('category.index')}}'
                        }else {
                            const errorMessages = data.errors;
                            let errorList = document.getElementById('errorContainer');
                            Object.keys(errorMessages).forEach(key => {
                                errorMessages[key].forEach(error => {
                                    const errorField = document.createElement("span");
                                    errorField.setAttribute("class", "text-danger");
                                    errorField.innerHTML= key + ": " + error;
                                    errorList.appendChild(errorField)
                                })
                            })
                        }
                    })
            }
        </script>

    </section>
    <!-- /.content -->
@endsection
