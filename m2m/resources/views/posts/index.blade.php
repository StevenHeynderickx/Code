@extends('layouts.default')
@section('title', 'Poses')

    @section('head')
        <style>

            .body{
                color:#414141;
                border:1px solid #414141;
                border-radius:5px;
                margin-bottom:10px;
                padding:10px;
            }
        </style>
        @endsection
@section('content')
<div class="container">
    <div class="row">
        <h1>Posts</h1>

        @foreach($categories as $category)
            @if(count($category->posts) > 0)
                <h2>{{ $category->name }}</h2>
                <h3>Posts count: {{ count($category->posts) }}</h3>
                @foreach($category->posts as $post)
                    <div class="body">{{ $post->body }}</div>
                @endforeach
            @endif
        @endforeach
    </div>
</div>
@endsection