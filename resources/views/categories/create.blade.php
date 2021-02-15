@extends('layouts.crud-nav')

@section('tailwind')
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')

<x-form-nav type="categories" />

  <form method="POST" 
      action="/categories" 
      class="bio-form flex-col" 
      enctype="multipart/form-data">

      <h1 style="color:#5acd86;"> New Category </h1>

      @include('categories.form', [
          'category' => new App\Models\Category,
      ])

  </form> <!-- Category form end -->

@endsection