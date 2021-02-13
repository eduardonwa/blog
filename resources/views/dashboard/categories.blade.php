@extends('layouts.home')

@section('fontawesome')
    <script src="https://kit.fontawesome.com/aded4e055e.js" crossorigin="anonymous"></script>   
@endsection

@section('content')

    <div id="top">
        <div class="categories-list">
            <button id="addBtn">Add Category</button>
            <div id="categoryModal" class="modal">

                <div class="modal-content">
                    <span class="close-modal">&times;</span>

                    <form method="POST" action="/categories" class="bio-form" enctype="multipart/form-data">
                        @csrf

                        <h1> <strong> New Category </strong> </h1>

                        <span> <strong> Name </strong> </span>
                        <input
                        class="@error('name')is-danger @enderror"
                        type="text"
                        name="name">
                        @error('name')
                        <p class="is-danger">
                            {{ $errors->first('name') }}
                        </p>@enderror

                        <span> <strong> Icon </strong> </span>
                        <input
                        class="@error('icon')is-danger @enderror"
                        type="file"
                        name="icon">
                        @error('icon')
                        <p class="is-danger">
                            {{ $errors->first('icon') }}
                        </p>@enderror
                        <button> Submit </button>
                    </form> <!-- Category form end -->

                </div> <!-- Modal content end -->
            </div> <!-- Modal end -->
        </div> <!-- Categories list -->
    </div>

    <div id="middle"> 
        <div class="mid-top-utility">
            <div class="index-header">
                <span> 
                    <strong> Icon </strong>
                </span>
                <span> 
                    <strong> Name </strong>
                </span>
                <span> 
                    <strong> Created at </strong>
                </span>
                <span> 
                    <strong> Actions </strong>
                </span>
            </div> <!-- Index header end -->
            <div class="index-content">
                @foreach($category as $category)
                <span> <img src="{{ asset('/storage/img/category/'.$category->image_url) }}" alt="category"> </span>
                <span> {{ $category->name }} </span>
                <span> {{ $category->created_at }} </span>

                <span class="action-btn">
                    <a href="/categories/{{$category->id}}/edit"> <button class="update-btn"> <span> <i class="fas fa-sync-alt"></i> Update </span> </button> </a>
                        <form method="POST" action="{{ route('categories.destroy', ['category' => $category]) }}">
                                @csrf
                                @method('DELETE')
                            <button class="danger-btn" type="submit" onclick="return confirm('Are you sure you want to delete this?')"> <span> <i class="fas fa-skull-crossbones"></i> Delete </span> </button>
                        </form>  
                </span>
                @endforeach
            </div> <!-- Index content end -->
        </div> <!-- Mid top end -->
    </div> <!-- TOP END -->

    <script>
        var modal = document.getElementById("categoryModal");
        var btn = document.getElementById("addBtn");
        var span = document.getElementsByClassName("close-modal")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection