<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use File;
use Auth;
use App\Post;
use App\User;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\PostMiddleware');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $users = User::all();
        return view('posts', ['posts' => $posts, 'users' => $users]);
    }

    public function createPost()
    {
        return view('createPost');
    }

    public function addPost(Request $request)
    {
    	$user = Auth::user();
    	
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:35',
            'description' => 'required|max:255',
            'body' => 'required',
            'image' => 'image',
        ]);

        if ($validator->fails()) {
            return redirect('/posts/create')->withErrors($validator)->withInput();
        } else {
            Post::create([
            	'poster_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'body' => $request->body,
                'imageURL' => '',
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $latestpost = Post::orderBy('created_at', 'desc')->first();
                $latestpost->imageURL = 'postImages/' . 'image-' . $latestpost->id . '.' . $image->getClientOriginalExtension();
                $latestpost->save();

                $image->move(public_path('postImages/'), 'image-' . $latestpost->id . '.' . $image->getClientOriginalExtension());
            }

            if ($user->user_role == 'admin') {
	        	return redirect('/admin')->with('success-message', 'New post successfully created!');
	        } else if ($user->user_role == 'editor') {
	        	return redirect('/posts')->with('success-message', 'New post successfully created!');
	        }
        }
    }

    public function editPost(Request $request)
    {
    	$post = Post::find($request->id);

        return view('editPost', ['post' => $post]);
    }

    public function postEditPost(Request $request)
    {
        $post = Post::find($request->id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:35',
            'description' => 'required|max:255',
            'body' => 'required',
            'image' => 'image',
        ]);

        if ($validator->fails()) {
            return redirect('/posts/edit/' . $request->id)->withErrors($validator)->withInput();
        } else {
            if ($post->imageURL == '' && $request->hasFile('newImg')){
                $image = $request->file('newImg');

                $post->imageURL = 'postImages/' . 'image-' . $post->id . '.' . $image->getClientOriginalExtension();
                $post->save();

                $image->move(public_path('postImages/'), 'image-' . $post->id . '.' . $image->getClientOriginalExtension());
            } else if ($post->imageURL != '' && $request->hasFile('newImg')) {
                unlink(public_path($post->imageURL));

                $image = $request->file('newImg');

                $post->imageURL = 'postImages/' . 'image-' . $post->id . '.' . $image->getClientOriginalExtension();
                $post->save();

                $image->move(public_path('postImages/'), 'image-' . $post->id . '.' . $image->getClientOriginalExtension());
            }

            $post->title = $request->title;
            $post->description = $request->description;
            $post->body = $request->body;
            $post->save();

            return redirect('/posts')->with('success-message', 'Post information successfully edited!');
        }
    }

    public function deletePost(Request $request)
    {
    	$user = Auth::user();

        $post = Post::find($request->id);
        unlink(public_path($post->imageURL));
        $post->delete();

        if ($user->user_role == 'admin') {
        	return redirect('/admin')->with('success-message', 'Post successfully deleted!');
        } else if ($user->user_role == 'editor') {
        	return redirect('/posts')->with('success-message', 'Post successfully deleted!');
        }
    }
}
