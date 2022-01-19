<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class Post_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }
    public function index() {
        $post = Post::latest()->with(['user', 'likes'])->paginate(5); //$post = Post::get(); //get all the posts in laravel collections
        return view('posts.index', [  //latest() alternate: orderBy('created_at', 'desc')->;
            'posts' => $post
        ]);
    }

    public function show(Post $post) {
        return view('posts.show', [  
            'post' => $post
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create([ //$request->user()->posts()->create($request->only('body'));
            'body' => $request->body
        ]);

        return back();
    }

    public function destroy(Post $post) {
        //if(!$post->owned_by(auth()->user())) {
            //dd('Error');
        //}
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }

}
