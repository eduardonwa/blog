@extends('layouts.app')

@section('tailwind')
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">    
@endsection

@section('content')

  <div class="posts-index">
    @forelse ($posts as $post)
      @if (isset($post->category->image_url))
        <img src="{{ asset('/storage/img/category/'.$post->category->image_url) }}" alt="Category"/> 
        @else
        <img src="/img/no-category.png" alt="Not found category"/>
      @endif
      <a href="/posts/{{ $post->slug }}">
        <div onmouseenter="hoverState(this)" onmouseleave="noHover(this)" class="post-desc">
          <h1> {{ $post->title }} </h1> 
          <p> {{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }} </p>
        </div> <!-- Post description end -->
      </a>
        @empty
        <p class="empty-msg"> No posts yet </p>
    @endforelse
  </div> <!-- Posts index end -->

  <span> {{ $posts->appends(['tag' == $posts])->links() }} </span>

@endsection

<script>
  function hoverState(x) {
    x.style.cssText = "background-color: rgba(0,0,0, .5);transition-duration: .2s; transition-delay: .1s;";
  }

  function noHover(x) {
    x.style.cssText = "background-color: #2d3748; border:none;";
  }
</script>