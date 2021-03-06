@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crea un nuovo post</h1>
    
        <form action="{{route("posts.store")}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci il titolo del post" value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label for="content">Post Text</label>
                <textarea class="form-control" id="content" name="content" rows="7" placeholder="Inserisci il testo del post">{{old('content')}}</textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="posted"  name="posted" {{old('posted') ? 'checked' : ''}}>
                <label  class="form-check-label" for="posted">Publish</label>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Crea</button>
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