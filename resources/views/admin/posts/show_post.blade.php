@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{$post->title}}</h2>
        <p>{{$post->content}}</p>
        <p>slug: {{$post->slug}}</p>
        @if ($post->posted)
            <h5 class="card-title text-success">published</h5>
        @else
            <h5 class="card-title text-danger">Un-published</h5>
        @endif
        <div class="d-flex">
            <a href="{{route('posts.index')}}"><button type="button" class="btn btn-success">Back Home Page</button></a>
            <a href="{{route('posts.edit', $post->id)}}"><button type="button" class="btn btn-warning">Edit post</button></a>
            <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete the post</button>
            </form>
      
        </div>
    </div>
@endsection