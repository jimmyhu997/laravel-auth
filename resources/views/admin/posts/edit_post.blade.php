@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit the post {{$post->slug}}</h1>
    
        <form action="{{route("posts.update", $post->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo del post" value="{{old('title') ? old('title') : $post->title}}">
            </div>
            <div class="form-group">
                <label for="content">Post Text</label>
                <textarea class="form-control" id="content" name="content" rows="7" placeholder="Inserisci il testo del post">{{old('content') ? old('content') : $post->content}}</textarea>
            </div>
            <div class="form-group form-check">
                @php
                    $posted = old('posted') ? old('posted') : $post->posted;
                @endphp
                <input type="checkbox" class="form-check-input" id="posted"  name="posted" {{$posted ? 'checked' : ''}}>
                <label  class="form-check-label" for="posted">Publish</label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{route('posts.index')}}"><button type="button" class="btn btn-success">Back Home Page</button></a>
            </div>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection