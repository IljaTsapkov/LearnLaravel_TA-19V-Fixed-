@extends('layout')
@section('title', $post->title)
@section('content')
    <a class="btn btn-primary" href="{{url()->previous()}}">Back</a>
    <div class="card mt-3">
        @if($post->images->count() > 1)
            @include('partials.carousel', ['images' => $post->images, 'id' => $post->id])
        @elseif($post->images->count() == 1)
            <img src="{{$post->images->first()->path}}" class="card-img-top">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{!! $post->displayBody !!}</p>
            <p class="card-text text-muted">{{ $post->user->name }}</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <form action="/post/{{$post->id}}" method="POST">
                <textarea class="form-control" name="body"></textarea>
                @csrf
                <input type="submit" class="btn-primary">
            </form>
        </div>
    </div>

    @foreach($post->comments as $comment)
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="card-title">{{ $comment->body }}</h5>
                <p class="card-text">{{ $comment->user->name }}</p>
                <p class="card-text text-muted">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        </div>
    @endforeach
@endsection
