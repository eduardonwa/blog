@extends('layouts.app')

@section('flickity')
  <link href="{{ asset('/css/flickity.css') }}" rel="stylesheet">
@endsection

@section('fontawesome')
    <script src="https://kit.fontawesome.com/aded4e055e.js" crossorigin="anonymous"></script>   
@endsection

@if(session('message'))
  <p> {{ session('message') }} </p>
@endif

@section('content')

        <div class="card-content">
          <h1 class="latest-header"> Latest Videos </h1>
              <div class="video">
                <section id="video"></section>
                <span style="text-align:center;padding-bottom:5px;color:gainsboro;"> Scroll down <i class="fas fa-level-down-alt"></i></span> 
                <main style="background-color:#5acd86;color:white;font-weight:bold;height:377px;overflow: scroll;cursor:pointer;"></main>
              </div>
          <h1 class="words-header"> Quick Words </h1>
            
            <div class="quick-words">
              @foreach($posts as $post)
                <div class="excerpt">
                  <img src="{{asset('/storage/img/post_uploads/'.$post->image_url) }}" alt="postimage"/> 
                  <div class="excerpt-details">
                    <a href="/posts/{{ $post->slug }}"> <h1> {{ $post->title }} </h1> </a>
                    <p> {{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }}</p>
                    <a class="btn-readmore" href="/posts/{{ $post->slug }}"> 
                      <button class="btn-readmore"> Read more </button>
                    </a>
                  </div> 
                </div> <!-- Excerpt end -->
              @endforeach
              <a class="posts-shortcut" href="/posts"> Jump to posts index </a>
            </div>

            <div class="bio">
              <h1 class="bio-header"> About </h1>
              @foreach ($about as $about)
              <img src="{{asset('/storage/img/profile_pic/'.$about->image_url) }}" alt="profilepicture"/>         
                <div class="bio-message">
                  {!! $about->message !!}
                  <a href="/contact"><button> Contact Me </button></a>
                </div>

                <div class="bio-currently">

                  <strong> Currently Reading </strong>
                  <p> {{ $about->reading_string }} </p>
                  <br/>
                  <strong> Last listened to </strong> 
                  <a href="{{ $about->listening_url }}"> <p> {{ $about->listening_string }} </p> </a>
                  @endforeach
                </div>
                
            </div>
        </div> <!-- Main content end -->

        <footer class="footer">thx for visiting</footer>

        <!-- Fitvids -->
        <script src="//rawgithub.com/davatron5000/FitVids.js/master/jquery.fitvids.js"></script>
        <script>
          $(document).ready(function(){
            $(#youtube).fitVids();
          });
        </script>
      
        <script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
        <script>
    
          $(document).ready(function () {
    
              var key = 'AIzaSyCrg9VmVg5O2ghb-WMiXkq4GiHBjANfT6Q';
              var playlistId = 'PL_C6EJ5jH-WcdGuxPOYiSfFgAEXevbpnC';
              var URL = 'https://www.googleapis.com/youtube/v3/playlistItems';
    
    
              var options = {
                  part: 'snippet',
                  key: key,
                  maxResults: 5,
                  playlistId: playlistId
              }
    
              loadVids();
    
              function loadVids() {
                  $.getJSON(URL, options, function (data) {
                      var id = data.items[0].snippet.resourceId.videoId;
                      mainVid(id);
                      resultsLoop(data);
                  });
              }
    
              function mainVid(id) {
                  $('#video').html(`
                    <iframe id="youtube" width="377" height="233" src="https://www.youtube.com/embed/${id}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                  `);
              }
    
              function resultsLoop(data) {
    
                  $.each(data.items, function (i, item) {
    
                      var thumb = item.snippet.thumbnails.medium.url;
                      var title = item.snippet.title;
                      var vid = item.snippet.resourceId.videoId;
    
    
                      $('main').append(`
                        <article class="item" data-key="${vid}">
    
                          <img src="${thumb}" style="margin:0 auto;">
                          <div style="padding:13px 0;text-align:center;">
                            <h4>${title}</h4>
                          </div>
    
                        </article>
                      `);
                  });
              }
              // CLICK EVENT
              $('main').on('click', 'article', function () {
                  var id = $(this).attr('data-key');
                  mainVid(id);
              });
    
          });
        
        </script>
@endsection