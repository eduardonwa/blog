@extends('layouts.app')

@section('content')

  <div class="posts-index">
    @forelse ($posts as $post)
        <img src="{{ asset('/storage/img/category/'.$post->category->image_url) }}" alt="Category"/> 
      <div class="post-desc">
        <a href="/posts/{{ $post->slug }}"> <h1> {{ $post->title }} </h1> </a>
        <p> {{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }} </p>
        <div class="button-area">
          <a href="/posts/{{ $post->slug }}"> 
            <button class="btn-readmore"> Read more </button>
          </a>
        </div> <!-- Button area end -->
      </div> <!-- Post description end -->
        @empty
        <p class="empty-msg"> No posts yet </p>
    @endforelse
  </div> <!-- Posts index end -->

  <span> {{ $posts->appends(['tag' == $posts])->links() }} </span>

@endsection