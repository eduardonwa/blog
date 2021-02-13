@extends('layouts.app')

@section('tinymce')
<script src="https://cdn.tiny.cloud/1/aws4tj8xvv0v21y5rqa92ji4fbcmc2kfg9ti1iqnvkz7kgxd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'#bodyArea',
            plugins: 'emoticons table link code image lists',
            menubar: false,
            toolbar: 'bold italic underline | emoticons blockquote | image link | alignleft aligncenter alignright alignjustify | bullist | forecolor | fontselect formatselect lineheight',
            mobile: {
                theme: 'mobile'
            },
            encoding: 'xml html'
        });
    </script>
@endsection

@section('content')

    <form class="newpost-form" 
        method="POST" 
        action="/posts" 
        enctype="multipart/form-data">
        
        <h1 style="color:#5acd86;"> New Post </h1>

        @include('posts.form', [
            'post' => new App\Models\Post
        ])
    </form> <!-- Form end -->

    <script>
        const barSesh = document.querySelector(".sesh-bar");
        barSesh.style.display = "none";
        const topBar = document.querySelector(".top-bar");
        topBar.style.cssText = "grid-template-columns: 1fr;";
        const single = document.querySelector(".social-bar");
        single.style.display = "none";
        const links = document.querySelector(".menu-bar");
        links.style.display = "none";
    </script>

@endsection