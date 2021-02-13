@extends('layouts.app')

@section('content')

  <div class="posts-index">

    @foreach ($posts as $post)
      <img src="{{asset('/storage/img/category/'.$post->category->image_url) }}" alt="Category"/> 
    <div class="post-desc">
      <a href="/posts/{{ $post->slug }}"> <h1> {{ $post->title }} </h1> </a>
      <p> {{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }} </p>
      <div class="button-area">
        <a href="/posts/{{ $post->slug }}"> 
          <button class="btn-readmore"> Read more </button>
        </a>
      </div> <!-- Button area end -->
    </div> <!-- Post description end -->
    @endforeach
    
  </div> <!-- Posts index end -->
  
  <span>Category:<strong>{{$post->category->name}}</strong></span>

@endsection