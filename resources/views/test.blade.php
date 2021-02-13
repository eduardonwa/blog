@extends('layouts.app')

@section('content')
    @foreach ($post as $post)
        <p> {{ $post }} </p>
    @endforeach
@endsection