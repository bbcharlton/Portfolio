<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RootController extends Controller {
	public function home() {
		return view('home', ['users' => ['Bailey', 'Bob', 'Joe', 'George'], 'loggedIn' => true]);
	}

	public function contact() {
		return view('contact');
	}

	public function store(Request $request) {
		$valid = $this->validate($request, [
			'name' => 'required|max:255',
			'email' => 'required|email',
			'msg' => 'required'
		]);
		
		return view('thankyou');
	}
}

?>