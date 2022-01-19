<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class User_Post_Controller extends Controller
{
    public function index(User $user) {
        $posts = $user->posts()->with(['user', 'likes'])->paginate('5');
        return view('users.posts.index',[
        'user' => $user,
        'posts' => $posts,
        ]);
    }
}
