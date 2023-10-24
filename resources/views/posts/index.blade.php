@extends('layouts.app')

@section('content')
@foreach ($posts as $post)
<div class="card col-md-6 offset-md-3 my-4">
    <div class="card-header">
        <div class="d-flex align-items-center">
            @if($post->user->image)
                <img src="{{ asset('storage/' . $post->user->image->imgpath) }}" alt="Image Alt Text" width="50" height="50">
            @endif
            <h3 class="ml-3">{{ $post->user->name }}</h3>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $post->title}}</h5>
        <p class="card-text">{{ $post->content}}</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
@endforeach
@endsection