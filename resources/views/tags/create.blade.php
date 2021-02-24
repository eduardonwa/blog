@extends('layouts.crud-nav')

@section('tailwind')
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <x-form-nav type="tags" />

    <h1 class="text-center m-8 text-2xl"> New Tag </h1>

    <form class="bio-form m-auto w-5/6"
            method="POST"
            action="/tags">

        @include('tags.form', [
            'tag' => new App\Models\Tag,
        ])
        
    </form>

@endsection