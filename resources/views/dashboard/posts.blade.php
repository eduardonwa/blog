@extends('layouts.home')
@section('fontawesome')
    <script src="https://kit.fontawesome.com/aded4e055e.js" crossorigin="anonymous"></script>   
@endsection
@section('content')

    <div id="top">                
        <div class="tools">
            <a href="/posts/create"> <button> <i class="fas fa-bolt"></i> NEW POST </button> </a>
            <button class="tablinks" onclick="openTab(event, 'published')" id="defaultOpen"><i class="fas fa-check-circle"></i> Published </button>
            <button class="tablinks" onclick="openTab(event, 'drafts')" id="defaultOpen"><i class="fab fa-firstdraft"></i> Drafts </button>
            <button class="tablinks" onclick="openTab(event, 'comments')"> <i class="fas fa-comment"></i> Comments </button>
        </div>
    </div> <!-- TOP END -->

    <div id="middle">
        <div class="mid-top-utility"> 
            
            <div id="published" class="tabcontent">
                @if (session('success'))
                    <p>{{ session('success') }}</p>
                @endif
                <div class="index-header">
                    <span> 
                        <strong> Title </strong>
                    </span>
                    <span> 
                        <strong> Category </strong>
                    </span>
                    <span> 
                        <strong> Tags </strong>
                    </span>
                    <span> 
                        <strong> Actions </strong>
                    </span>
                </div>
                <div class="index-content">
                    @forelse ($posts->sortByDesc('created_at') as $post)
                        @if($post->is_approved == 1)
                            <a class="post-title" href="/posts/{{ $post->slug }}"> <p> {{ $post->title }} </p> </a>
                                <p class="post-category"> {{ $post->category->name }} </p>
                            @foreach ($post->tags as $tag)
                                <p class="post-tags"> #{{ $tag->name }} </p>
                            @endforeach
                        <span class="action-btn">
                            <a href="/posts/{{$post->slug}}/edit"> <button class="update-btn"> <span> <i class="fas fa-sync-alt"></i> Update </span> </button> </a>
                            <form method="POST" action="{{ route('posts.destroy', [ 'post' => $post ])}}">
                                @csrf
                                @method('DELETE')
                            <button class="danger-btn" type="submit" onclick="return confirm('Are you sure you want to delete this?')"> <span> <i class="fas fa-skull-crossbones"></i> Delete </span> </button>
                            </form>
                        </span>
                        @endif
                            @empty
                            <p> Nothing to see here!</p>
                    @endforelse
                </div> 
            </div> <!-- Published tab end -->

            <div id="drafts" class="tabcontent">
                <div class="index-header">
                    <span> 
                        <strong> Title </strong>
                    </span>
                    <span> 
                        <strong> Category </strong>
                    </span>
                    <span> 
                        <strong> Tags </strong>
                    </span>
                    <span> 
                        <strong> Actions </strong>
                    </span>
                </div> 
                <div class="index-content">
                    @foreach ($posts->sortByDesc('created_at') as $post)
                        @if ($post->is_approved == 0)                
                        <a class="post-title" href="/posts/{{ $post->slug }}"> <p> {{ $post->title }} </p> </a>
                            <p class="post-category"> {{ $post->category->name }} </p>
                        @foreach ($post->tags as $tag)
                            <p class="post-tags"> #{{ $tag->name }} </p>
                        @endforeach
                    <span class="action-btn">
                        <a href="/posts/{{$post->slug}}/edit"> <button class="update-btn"> <span> <i class="fas fa-sync-alt"></i> Update </span> </button> </a>
                        <form method="POST" action="{{ route('posts.destroy', [ 'post' => $post ])}}">
                            @csrf
                            @method('DELETE')
                                <button class="danger-btn" type="submit" onclick="return confirm('Are you sure you want to delete this?')"> <span> <i class="fas fa-skull-crossbones"></i> Delete </span> </button>
                        </form>
                    </span>
                        @endif
                    @endforeach
                </div> 
            </div> <!-- Draft tab end -->
            
            <div id="comments" class="tabcontent">
                <h1> Comments </h1>
                <div class="comment-list">

                    <div class="index-header">
                        <span> 
                            <strong> Title </strong>
                        </span>
                        <span> 
                            <strong> Comments </strong>
                        </span>
                        <span> 
                            <strong> Last commented </strong>
                        </span>
                        <span> 
                            <strong> Actions </strong>
                        </span>
                    </div> <!-- Index header end -->

                    <div class="index-content">
                        @foreach ($posts->sortByDesc('created_at') as $post)
                            @if($post->is_approved == 1)
                                <a class="post-title"
                                    href="/posts/{{ $post->slug }}"> 
                                        {{ $post->title }}
                                </a>

                                <p class="post-category">
                                    {{  $post->comments->count() }}
                                </p>

                                <p class="post-tags"> 
                                    {{ $post->created_at->format("m/d/Y") }}
                                </p>

                                <span class="action-btn">
                                    <a class="post-title" 
                                        href="/posts/{{ $post->slug }}#comments"> 
                                        <button class="view-btn" id="listModal"> 
                                            <i class="fas fa-eye"></i> 
                                            List
                                        </button>
                                    </a>
                                </span>
                            @endif 
                        @endforeach
                    </div>
                    
                </div> <!-- Comments list end -->
            </div> <!-- Comments tab end -->

        </div> <!-- Mid top utility end -->
    </div> <!-- MIDDLE END -->

    <script>
        const middle = document.getElementById('middle');
        middle.style.cssText = "background-color: #2d3748;";

        function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
        }

        document.getElementById("defaultOpen").click();
    </script>
@endsection