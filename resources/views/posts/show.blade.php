@extends('layouts.app')

@section('bootstrap')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('fontawesome')
    <script src="https://kit.fontawesome.com/aded4e055e.js" crossorigin="anonymous"></script>   
@endsection

@section('content')

    <div class="single-post">

        <img src="{{asset('/storage/img/post_uploads/'.$post->image_url) }}" alt="postimage"/> 
        <h1 class="header-post"> {{ $post->title }} </h1>
        {!! $post->body !!}
        <p class="space-tags"> Tags:
            @foreach ($post->tags as $tag)
                <a href="/posts?tag={{ $tag->name }}"> 
                    {{ $tag->name }}
                </a>
            @endforeach
        </p>
        <div>
            Category:
            <span style="color:#87ceeb;">
                @if (isset($post->category->name))
                    {{ $post->category->name }}
                @else
                    Not found category
                @endif
            </span>

                <hr> 

            <span style="background-color:#5acd86; color: black;"> 
                {{ $post->created_at->format("m/d/Y") }}
            </span>
        </div>
        <x-navalt/>

        <div class="comment-box" id="comments">
            @comments(['model' => $post,
                        'perPage' => 8])
        </div>
        
    </div> <!-- Single post end -->
        

    <script>
        const topBar = document.querySelector(".top-bar");
        topBar.style.cssText = "grid-template-columns: 1fr;";
        const menuBar = document.querySelector(".menu-bar");
        menuBar.style.cssText = "color: white;";
        const single = document.querySelector(".social-bar");
        single.style.display = "none";
    </script>
@endsection