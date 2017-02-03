<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('home', ['posts' => $posts, 'users' => $users]);
    }

    public function getPost(Request $request)
    {
        $post = Post::find($request->id);
        $users = User::all();
        return view('post', ['post' => $post, 'users' => $users]);
    }
}
