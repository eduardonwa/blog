@extends('layouts.crud-nav')

@section('tailwind')
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    
<a href="#join-modal">Join</a>

<div id="join-modal" class="overlay">
    <div class="modal">
        <h1>Pick a Plan</h1>
        <p style="color: white;">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
            Quo esse suscipit quidem voluptatem fugiat itaque iusto 
            odio pariatur! Sint possimus veritatis consectetur ratione.
        </p>
    </div>
</div>

@endsection