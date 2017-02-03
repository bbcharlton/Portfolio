<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Validator;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\AdminMiddleware');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $posts = Post::all();
        return view('admin', ['users' => $users, 'posts' => $posts]);
    }

    public function createUser()
    {
        return view('createUser');
    }

    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:35',
            'lastname' => 'required|max:35',
            'email' => 'required|email|max:255|unique:users',
            'user_role' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/admin/user/create')->withErrors($validator)->withInput();
        } else {
            User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'user_role' => $request->user_role,
                'password' => bcrypt($request->password),
            ]);

            return redirect('/admin')->with('success-message', 'New user successfully created!');
        }
    }

    public function editUser(Request $request)
    {
        $user = User::find($request->id);

        if ($user->user_role != 'admin') {
            return view('editUser', ['user' => $user]);
        } else {
            return redirect('/admin')->with('failure-message', 'Cannot edit admin users!');
        }
    }

    public function postEditUser(Request $request)
    {
        $user = User::find($request->id);

        if ($user->user_role != 'admin') {
            $validator = Validator::make($request->all(), [
                'firstname' => 'required|max:35',
                'lastname' => 'required|max:35',
                'email' => 'required|email|max:255',
                'user_role' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect('/admin/user/edit/' . $request->id)->withErrors($validator)->withInput();
            } else {
                $user->firstname = $request->firstname;
                $user->lastname = $request->lastname;
                $user->email = $request->email;
                $user->user_role = $request->user_role;

                $user->save();

                return redirect('/admin')->with('success-message', 'User information successfully edited!');
            }
        } else {
            return redirect('/admin')->with('failure-message', 'Cannot edit admin users!');
        }
    }

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);

        if ($user->user_role != 'admin') {
            $user->delete();
            return redirect('/admin')->with('success-message', 'User successfully deleted!');
        } else {
            return redirect('/admin')->with('failure-message', 'Cannot delete admin users!');
        }
    }
}
