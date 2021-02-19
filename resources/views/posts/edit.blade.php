@extends('layouts.crud-nav')

@section('fontawesome')
    <script src="https://kit.fontawesome.com/aded4e055e.js" crossorigin="anonymous"></script> 
@endsection

@section('tinymce')
    <script src="https://cdn.tiny.cloud/1/aws4tj8xvv0v21y5rqa92ji4fbcmc2kfg9ti1iqnvkz7kgxd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector:'#bodyArea',
            plugins: 'emoticons table link code image lists',
            menubar: false,
            toolbar: 'bold italic underline | emoticons blockquote | image link | alignleft aligncenter alignright alignjustify | bullist | forecolor | fontselect formatselect lineheight',
            max_height: 700,
            skin: 'oxide-dark',
            content_css : '/css/dark.css',
            mobile: {
                theme: 'mobile'
            },
            encoding: 'xml html'
        });
    </script>
@endsection

@section('tailwind')
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')

<x-form-nav type="posts" />

    <h1 class="text-center m-8 text-2xl"> Edit Post </h1>

    <form method="POST" 
        action="/posts/{{ $post->slug }}" 
        class="newpost-form m-auto w-5/6"
        enctype="multipart/form-data">
        @method('PUT')
    
        @include('posts.form', [
            'submitButtonText' => 'Update Post',
            'category' => App\Models\Category::get()
        ])
    </form> <!-- Form end -->

@endsection