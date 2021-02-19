@extends('layouts.home')

@section('tinymce')
    <script src="https://cdn.tiny.cloud/1/aws4tj8xvv0v21y5rqa92ji4fbcmc2kfg9ti1iqnvkz7kgxd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'#bioArea',
            plugins: 'emoticons table link code image lists',
            menubar: false,
            toolbar: 'bold italic underline | emoticons blockquote | image link | alignleft aligncenter alignright alignjustify | numlist bullist table | forecolor backcolor | fontselect formatselect lineheight',
            skin: 'oxide-dark',
            content_css : '/css/dark.css',
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

@section('tailwind')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <div id="top">
        <div class="session-msg">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            You are now logged in, {{ Auth::user()->name }}
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
        </div> <!-- tools end -->
        
        <a href="/posts/create"> 
            <button class="p-2 bg-green-600 hover:bg-green-700 active:bg-green-900 w-36 rounded-md transition delay-150 duration-300 ease-in-out"> 
                <i class="fas fa-bolt"></i> 
                    NEW POST 
            </button> 
        </a> <!-- create btn end -->

    </div> <!-- TOP END -->

    <div id="middle">
        <div class="mid-top-utility">
            <div class="read-home">

                <div onmouseenter="hoverState(this)" 
                    onmouseleave="noHover(this)" 
                        class="bg-gray-700 mb-8 w-full rounded-sm border-2 border-4 border-light-blue-500 border-opacity-100 hover:bg-gray-500
                        flex flex-col items-center justify-center ">
                    <h1 id="about" 
                        class="font-bold text-yellow-200"> 
                            About 
                    </h1>
                        @foreach($about as $about)
                            <img class="rounded-full h-24 w-24" src="{{asset('/storage/img/profile_pic/'.$about->image_url) }}" alt="profilepicture"/> 
                            <p class="pt-5"> {{ substr(strip_tags($about->message), 0, 200) }}{{ strlen(strip_tags($about->message)) > 300 ? "..." : "" }} </p>
                            <span class="text-green-300"> Currently Reading: </span>
                                <p> {{ $about->reading_string }} </p>
                            <br/>
                            <span class="text-green-300"> Last listened to: </span> 
                                <a href="{{ $about->listening_url }}"> 
                                <p> {{ $about->listening_string }} </p> 
                            </a>
                        @endforeach
                    <button class="browse-btn" id="updateBtn">Update</button>
                </div> <!-- about end -->

                <div onmouseenter="hoverState(this)"
                    onmouseleave="noHover(this)" 
                    class="bg-gray-700 mb-8 w-full rounded-sm border-2 border-4 border-light-blue-500 border-opacity-100 hover:bg-gray-500">
                    <h1 class="font-bold text-yellow-200"> Categories </h1>
                        @foreach($category as $category)
                            <p> {{$category->name}} </p>
                        @endforeach
                    <a class="browse-btn" 
                        href="/dashboard/categories"> 
                            Browse 
                    </a>
                </div> <!-- categories end -->

            </div> <!-- read home end -->

            <div id="bioModal" class="modal">
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    
                    <form method="POST" 
                            action="/about" 
                            class="bio-form" 
                            enctype="multipart/form-data">
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
                            class="rounded-md h-12 border focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent bg-transparent"
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

                        <input
                            class="rounded-md h-12 border focus:outline-none focus:ring-2 active:rounded-md focus:ring-purple-600 focus:border-transparent bg-transparent"
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
                            class="rounded-md h-12 border focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent bg-transparent"
                            type="text"
                            name="listening_url"
                            class="@error('listening_url')is-danger @enderror"
                            required>

                        @error('listening_url')
                            <p class="is-danger"> 
                                {{ $errors->first('listening_url')}}
                            </p>
                        @enderror
                        
                        <div class="pt-4">
                            <label class="block text-base font-medium text-white-700 text-center pb-4">
                                Upload file
                            </label>
                            
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 
                                        border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <div class="flex flex-col text-sm">  
                                        <label for="file-upload" 
                                                class="relative cursor-pointer rounded-md font-medium">
                                            <input id="file-upload" 
                                                    name="profile" 
                                                    type="file"
                                                    required
                                                    class="sr-only @error('profile')is-danger @enderror">
                                            <img src="/img/search-img-gray.png" id="preview" class="w-24"/>
                                        </label>
                                        @error('profile')
                                            <p class="is-danger">
                                                {{ $errors->first('profile') }}
                                            </p>
                                        @enderror
                                    </div>  
                                </div>
                            </div>
                        </div> <!-- image end -->

                        <button class="submit-btn"> 
                            Update Now 
                        </button>
                    </form>
                </div>
            </div> <!-- Modal end -->
        </div> <!-- Mid top utility end -->

        <div class="mid-bottom-utility">
            <div class="read-home">  
                <div onmouseenter="hoverState(this)" 
                    onmouseleave="noHover(this)" 
                    class="bg-gray-700 mb-8 w-full rounded-sm border-2 hover:bg-gray-500">
                    <h1 class="p-5 font-bold text-yellow-200"> Published Posts </h1>
                        @foreach($posts as $post)
                            @if($post->is_approved == 1)
                                <a href="/posts/{{$post->slug}}"> <p class="no-underline hover:underline"> {{$post->title}} </p> </a>
                            @endif
                        @endforeach
                    <a class="browse-btn" 
                        href="/dashboard/posts"> 
                        Browse 
                    </a>
                </div>

                <div onmouseenter="hoverState(this)" 
                    onmouseleave="noHover(this)" 
                    class="bg-gray-700 mb-8 w-full rounded-sm border-2 hover:bg-gray-500">
                    <h1 class="p-5 font-bold text-yellow-200"> Drafts </h1>
                        @foreach($posts as $post)
                            @if($post->is_approved == 0)
                                <a href="/posts/{{$post->slug}}"> <p class="no-underline hover:underline"> {{$post->title}} </p> </a>
                            @endif
                        @endforeach
                    <a class="browse-btn" 
                        href="/dashboard/posts"> 
                        Browse
                    </a>
                </div>

                <div onmouseenter="hoverState(this)" 
                    onmouseleave="noHover(this)" 
                    class="bg-gray-700 mb-8 w-full rounded-sm border-2 hover:bg-gray-500">
                    <h1 class="p-5 font-bold text-yellow-200"> Tags </h1>
                    @foreach ($tag as $tag)
                        <p> {{$tag->name}} </p>
                    @endforeach
                    <a class="browse-btn" 
                        href="/dashboard/posts"> 
                        Browse
                    </a>
                </div>
            </div>
        </div> <!-- Mid bottom utility end -->

    </div> <!-- MIDDLE END -->

    <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#file-upload").change(function(){
            readURL(this);
        });
    </script>

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

    <script>
        function hoverState(x) {
            x.style.cssText = "background-color: #1a202c;transition-duration: .2s; transition-delay: .1s;";
        }
        
        function noHover(x) {
            x.style.cssText = "background-color: #374151; border:none;";
        }
    </script>

@endsection