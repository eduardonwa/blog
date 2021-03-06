@extends('layouts.home')

@section('fontawesome')
    <script src="https://kit.fontawesome.com/aded4e055e.js" crossorigin="anonymous"></script>   
@endsection

@section('content')

    <div id="top">
        <div class="categories-list">
            <a href="/categories/create">
                <button id="addBtn">Add Category</button>
            </a>
        </div> 
    </div> <!-- top ends -->

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
                    <span> 
                        <img src="https://blog-img.s3.us-east-2.amazonaws.com/categories/{{ $category->image_url }}" alt="Category">
                    </span>

                    <span> {{ $category->name }} </span>
                    <span> {{ $category->created_at }} </span>

                    <span class="action-btn">
                        <a href="/categories/{{$category->id}}/edit">
                            <button class="update-btn">
                                <span>
                                    <i class="fas fa-sync-alt"></i>
                                        Update
                                </span>
                            </button>
                        </a>

                        <form method="POST" 
                                action="{{ route('categories.destroy', ['category' => $category]) }}">
                                @csrf
                                @method('DELETE')
                            <button class="danger-btn" 
                                    type="submit"
                                    onclick="return confirm('Are you sure you want to delete this?')">
                                    <span>
                                        <i class="fas fa-skull-crossbones"></i> 
                                            Delete
                                    </span>
                            </button>
                        </form> 
                         
                    </span>
                @endforeach
            </div> <!-- Index content end -->

        </div> <!-- Mid top end -->
    </div> <!-- TOP END -->

@endsection