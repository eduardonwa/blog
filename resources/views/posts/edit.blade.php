@extends('layouts.app')

@section('head')
<script src="https://cdn.tiny.cloud/1/aws4tj8xvv0v21y5rqa92ji4fbcmc2kfg9ti1iqnvkz7kgxd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection

@section('content')

    <form method="POST" 
        action="/posts/{{ $post->slug }}" 
        class="newpost-form" 
        enctype="multipart/form-data">
        @method('PUT')

        <h1 style="color:#5acd86;"> Update Post </h1>

        @include('posts.form', [
            'submitButtonText' => 'Update Post',
            'category' => App\Models\Category::get()
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

<script>
    tinymce.init({
        selector:'#bodyArea',
        plugins: 'emoticons table link code image list',
        menubar: false,
        toolbar: 'bold italic underline | emoticons blockquote | image link | alignleft aligncenter alignright alignjustify | table numlist bullist | forecolor backcolor | fontselect formatselect lineheight',
        mobile: {
            theme: 'mobile'
        },
        encoding: 'xml html'
    });
</script>

@endsection