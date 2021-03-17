@extends('layouts.app')

@section('content')
  <div class="card">
    <div class="card-header">{{ $post->user->name }}</div>
      <div class="card-body">
      <p class="card-text">{{ $post->body }}</p>
      @auth
        <form method="POST" action="{{ route('bookmarks.add', $post->id) }}">
          @csrf
          <button type="submit" class="btn btn-success">ブックマークする</button>
        </form>
      @endauth
      </div>
    </div>
  </div>

  <div class="container mt-4">
    @foreach($post->replies as $reply)
      <div class="card">
        <div class="card-header">{{ $reply->user->name }}</div>
        <div class="card-body">
          <p class="card-title">{{ $reply->body }}</p>
        </div>
      </div>
    @endforeach

  @auth
    @unless($bookmarked)
      <form method="POST" action="{{ route('bookmarks.add', $post->id) }}">
        @csrf
        <button type="submit" class="btn btn-success">ブックマークする</button>
      </form>
    @else
      <form method="POST" action="{{ route('bookmarks.remove', $post->id) }}">
        @csrf
        <button type="submit" class="btn btn-danger">ブックマークを解除する</button>
      </form>
    @endunless
  @endauth
  </div>
@endsection