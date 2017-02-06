<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
	public function store(Request $request) {
		$comment = new Comment;
		$comment->post_id = $request->post_id;
		$comment->user_id = 1;
		$comment->content = $request->content;
		$comment->save();

		return redirect('/posts/'.$request->post_id);
	}
}
