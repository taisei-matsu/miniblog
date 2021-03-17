<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user'])->latest()->get();

        return view('index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = new Post;
        $post->fill($request->all());
        $post->user()->associate(Auth::user());
        $post->save();

        return redirect()->to('/');
    }

    public function show(Post $post)
    {
        $post->load('replies.user');
        $bookmarked = $post->bookmarkingUsers->contains(Auth::id());

        return view('posts.show', ['post' => $post, 'bookmarked' => $bookmarked]);
    }
}
