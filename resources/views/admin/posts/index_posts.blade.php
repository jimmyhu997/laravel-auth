@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <a href="{{route('posts.create')}}"><button type="button" class="btn btn-success">Crea un nuovo post</button></a>
        </div>
        @foreach ($posts as $post)
            <div class="card my-5">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">{{$post->title}}</h5>
                    @if ($post->posted)
                        <h5 class="card-title text-success">published</h5>
                    @else
                        <h5 class="card-title text-danger">Un-published</h5>
                    @endif
                </div>
                <div class="card-body">
                    <p class="card-text">{{$post->content}}</p>
                    <p class="card-text">Slug: {{$post->slug}}</p>
                    <a href="{{route('posts.show', $post->id)}}"><button type="button" class="btn btn-primary">Show the post</button></a>
                    <a href="{{route('posts.edit', $post->id)}}"><button type="button" class="btn btn-warning">Edit post</button></a>
                    <div class="d-inline-block">
                        <form action="{{route('posts.destroy', $post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete the post</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection