<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Status;
use Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::find($request->id);
        $statuses = Status::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('profile', ['user' => $user, 'statuses' => $statuses]);
    }

    public function createStatus(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'status' => 'required|max:140',
        ]);

        if ($validator->fails()) {
            return redirect('/profile/' . $user->firstname . '.' . $user->lastname . '/' . $user->id)->withErrors($validator)->withInput();
        } else {
            Status::create([
                'text' => $request->status,
                'user_id' => $user->id,
            ]);

            return redirect('/profile/' . $user->firstname . '.' . $user->lastname . '/' . $user->id)->with('success-message', 'New status successfully created!');
        }
    }

    public function deleteStatus(Request $request)
    {
        $status = Status::find($request->id);

        $user = User::find($status->user_id);

        if (Auth::user()->user_role == 'admin') {
            $status->delete();
            return redirect('/profile/' . $user->firstname . '.' . $user->lastname . '/' . $user->id)->with('success-message', 'Status successfully deleted!');
        } else if ($status->user_id != Auth::id()) {
            return redirect('/profile/' . Auth::user()->firstname . '.' . Auth::user()->lastname . '/' . Auth::id())->with('failure-message', 'Cannot delete other user statuses!');
        } else {
            $status->delete();
            return redirect('/profile/' . $user->firstname . '.' . $user->lastname . '/' . $user->id)->with('success-message', 'Status successfully deleted!');
        }
    }

    public function editProfile(Request $request)
    {
        $user = User::find($request->id);
        if (Auth::user()->user_role == 'admin') {
            return redirect('/admin/user/edit/' . $request->id);
        } else if ($request->id != Auth::id()) {
            return redirect('/profile/' . Auth::user()->firstname . '.' . Auth::user()->lastname . '/' . Auth::id())->with('failure-message', 'Cannot edit other users!');
        } else {
            return view('editProfile', ['user' => $user]);
        }
    }

    public function postEditProfile(Request $request)
    {
        $user = user::find($request->id);

        $validator = Validator::make($request->all(), [
            'firstname' => 'required|max:35',
            'lastname' => 'required|max:35',
            'image' => 'image',
        ]);

        if ($validator->fails()) {
            return redirect('/profile/' . Auth::user()->firstname . '.' . Auth::user()->lastname . '/' . Auth::id())->withErrors($validator)->withInput();
        } else {
            if ($user->profilePicURL == '' && $request->hasFile('image')){
                $image = $request->file('image');

                $user->profilePicURL = 'profileImages/' . 'image-' . $user->id . '.' . $image->getClientOriginalExtension();
                $user->save();

                $image->move(public_path('profileImages/'), 'image-' . $user->id . '.' . $image->getClientOriginalExtension());
            } else if ($user->profilePicURL != '' && $request->hasFile('image')) {
                unlink(public_path($user->profilePicURL));

                $image = $request->file('image');

                $user->profilePicURL = 'profileImages/' . 'image-' . $user->id . '.' . $image->getClientOriginalExtension();
                $user->save();

                $image->move(public_path('profileImages/'), 'image-' . $user->id . '.' . $image->getClientOriginalExtension());
            }

            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->save();

            return redirect('/profile/' . Auth::user()->firstname . '.' . Auth::user()->lastname . '/' . Auth::id())->with('success-message', 'Profile information successfully edited!');
        }
    }
}
