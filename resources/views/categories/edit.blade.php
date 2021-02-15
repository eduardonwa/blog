@extends('layouts.crud-nav')

@section('tailwind')
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')

<x-form-nav type="categories" />

    <form method="POST" 
        action="/categories/{{$category->id}}"
        class="bio-form m-auto w-5/6"
        enctype="multipart/form-data">
        @method('PUT')

        <h1> Update Category </h1>

        @include('categories.form', [
            'submitButtonText' => 'Update',
        ])

    </form> <!-- Form end -->

@endsection