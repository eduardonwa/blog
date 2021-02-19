@extends('layouts.home')

@section('fontawesome')
    <script src="https://kit.fontawesome.com/aded4e055e.js" crossorigin="anonymous"></script>   
@endsection

@section('tailwind')
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <div id="top">
        <div>
            <a href="/tags/create">
                <button id="addBtn">Add Tag</button>
            </a>
        </div>
    </div>

    <div id="middle">
        <div class="mid-top-utility">
            <div class="index-header">
                <span> 
                    <strong> Name </strong>
                </span>
                <span> 
                    <strong> Posts </strong>
                </span>
                <span> 
                    <strong> Created at </strong>
                </span>
                <span> 
                    <strong> Actions </strong>
                </span>
            </div> <!-- Index header end -->
            <div class="index-content">
                
                @foreach($tags as $tag)
                    <span> {{ $tag->name }}</span>
                    <span> {{ $tag->posts()->count() }} </span>
                    <span> {{ Carbon\Carbon::parse($tag->created_at)->format('Y-m-d') }} </span>
                    <span> 
                        <a href="/tags/{{$tag->id}}/edit">
                            <button class="update-btn">
                                <span>
                                    <i class="fas fa-sync-alt"></i>
                                        Update
                                </span>
                            </button>
                        </a>

                        <form method="POST" 
                                action="">
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

            </div>
        </div>
    </div>


@endsection