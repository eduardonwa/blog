@extends('layouts.crud-nav')

@section('tailwind')
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <x-form-nav type="posts" />

    <form class="bio-form m-auto w-5/6"
            action="/tags/{{$tag->id}}"
            method="POST">
            @method('PUT')

            <h1> Update Tag </h1>
        
            @include('tags.form', [
                'submitButtonText' => 'Update',
            ])
    </form>

@endsection