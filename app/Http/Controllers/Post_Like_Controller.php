<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\Post_Liked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class Post_Like_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function store(Post $post, Request $request) {
        if($post->liked_by($request->user())) {
            return response(null,409);
        }
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        if(!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            Mail::to($post->user)->send(new Post_Liked(auth()->user(), $post));
        }
        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();
        return back();

    }
}
