@extends('layouts.home')

@section('tinymce')
<script src="https://cdn.tiny.cloud/1/aws4tj8xvv0v21y5rqa92ji4fbcmc2kfg9ti1iqnvkz7kgxd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'#bioArea',
            plugins: 'emoticons table link code image lists',
            menubar: false,
            toolbar: 'bold italic underline | emoticons blockquote | image link | alignleft aligncenter alignright alignjustify | numlist bullist table | forecolor backcolor | fontselect formatselect lineheight',
            mobile: {
                theme: 'mobile'
            },
            encoding: 'xml html'
        });
    </script>
@endsection

@section('fontawesome')
    <script src="https://kit.fontawesome.com/aded4e055e.js" crossorigin="anonymous"></script>   
@endsection

@section('content')

        <div id="top">
            <div class="session-msg">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                You are logged in, {{ Auth::user()->name }}
            </div> <!-- Session Message end -->
            <div class="tools">

                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); 
                    document.getElementById('form-logout').submit();"> 
                    <button> 
                        <i class="fas fa-external-link-alt"></i>
                        Logout
                    </button> 
                </a>

                <form id="form-logout"
                action="{{route('logout')}}"
                method="POST"
                style="display: none">
                    @csrf
                </form>

                <a href="/posts/create"> 
                    <button class="sesh-btn"> 
                        <i class="fas fa-bolt"></i> 
                        NEW POST </button> 
                </a> <!-- create -->

            </div> <!-- tools end -->

        </div> <!-- TOP END -->

        <div id="middle">

            <div class="mid-top-utility">
                
                <div class="bio-form">
                    <h1 id="about"> <strong> About </strong> </h1>
                        @foreach($about as $about)
                            <img src="{{asset('/storage/img/profile_pic/'.$about->image_url) }}" alt="profilepicture"/> 
                            <p> {{ substr(strip_tags($about->message), 0, 200) }}{{ strlen(strip_tags($about->message)) > 300 ? "..." : "" }} </p>
                            <span> Currently Reading: </span>
                            <p> {{ $about->reading_string }} </p>
                            <br/>
                            <span> Last listened to: </span> 
                            <a href="{{ $about->listening_url }}"> <p> {{ $about->listening_string }} </p> </a>
                        @endforeach
                    <button id="updateBtn">Update</button>

                    <hr style="width: 100%">

                    <h1> <strong> Categories </strong> </h1>
                    @foreach($category as $category)
                        <p> {{$category->name}} </p>
                    @endforeach
                <a class="browse-posts" href="/dashboard/categories"> Browse </a>
                </div>
            
                <div id="bioModal" class="modal">
                    <div class="modal-content">
                        <span class="close-modal">&times;</span>
                        
                        <form method="POST" action="/about" class="bio-form" enctype="multipart/form-data">
                            @csrf

                            <h1> <strong> Update About </strong> </h1>
                            
                            <textarea 
                                type="text"
                                name="message" 
                                cols="21" 
                                rows="8" 
                                id="bioArea" 
                                class="@error('message')is-danger @enderror"
                                required>
                                {{old('message')}} 
                            </textarea>

                            @error('message')
                                <p class="is-danger"> 
                                    {{ $errors->first('message')}}
                                 </p>
                            @enderror

                            <h1> <strong> Currently Reading </strong> </h1> 
                            <input
                                type="text"
                                name="reading_string"
                                class="@error('reading_string')is-danger @enderror"
                                required>

                            @error('reading_string')
                                <p class="is-danger"> 
                                    {{ $errors->first('reading_string')}}
                                </p>
                            @enderror

                            <h1> <strong> Currently Listening </strong> </h1> 

                            <span> Album/Artist info: </span>
                            <input
                                type="text"
                                name="listening_string"
                                class="@error('listening_string')is-danger @enderror"
                                required>

                            @error('listening_string')
                                <p class="is-danger"> 
                                    {{ $errors->first('listening_string')}} 
                                </p>
                            @enderror

                            <span> URL: </span>
                            <input
                                type="text"
                                name="listening_url"
                                class="@error('listening_url')is-danger @enderror"
                                required>

                            @error('listening_url')
                                <p class="is-danger"> 
                                    {{ $errors->first('listening_url')}}
                                </p>
                            @enderror
                            
                            <span> Profile Picture </span>
                            <input
                                type="file"
                                name="profile"
                                class="@error('profile')is-danger @enderror">

                            @error('profile')
                                <p class="is-danger">
                                    {{ $errors->first('profile') }}
                                </p>
                            @enderror

                            <button> Update Now </button>
                        </form>
                    </div>
                </div> <!-- Modal end -->

            </div> <!-- Mid top utility end -->

            <div class="mid-bottom-utility">

                <div class="read-home">
                    <h1> <strong> Published Posts </strong> </h1>
                    @foreach($posts as $post)
                        @if($post->is_approved == 1)
                            <a href="/posts/{{$post->slug}}"> <p> {{$post->title}} </p> </a>
                        @endif
                    @endforeach
                    <a class="browse-posts" href="/dashboard/posts"> Browse </a>

                    <hr style="width: 100%">
                    
                    <h1> <strong> Drafts </strong> </h1>
                    @foreach($posts as $post)
                        @if($post->is_approved == 0)
                            <a href="/posts/{{$post->slug}}"> <p> {{$post->title}} </p> </a>
                        @endif
                    @endforeach
                    <a class="browse-posts" href="/dashboard/posts"> Browse </a>
                </div>

            </div> <!-- Mid bottom utility end -->

        </div> <!-- MIDDLE END -->
        
        <script>
        var modal = document.getElementById("bioModal");
        var btn = document.getElementById("updateBtn");
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