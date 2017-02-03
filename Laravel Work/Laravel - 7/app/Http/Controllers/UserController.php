<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create() {
    	return view('users.new');
    }

    public function store(Request $request) {
    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = $request->password;
    	$user->save();
    	return redirect('posts');
    }
}
