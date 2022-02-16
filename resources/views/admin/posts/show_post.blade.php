@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{$post->title}}</h2>
        <p>{{$post->content}}</p>
        <a href="{{route('posts.index')}}"><button type="button" class="btn btn-success">Back Home Page</button></a>
        <a href="{{route('posts.edit', $post->id)}}"><button type="button" class="btn btn-warning">Edit post</button></a>
        <a href="{{route('posts.destroy', $post->id)}}"><button type="button" class="btn btn-danger">Delete the post</button></a>
    </div>
@endsection