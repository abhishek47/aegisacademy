<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function acheivements()
    {
        return view('profile.acheivements');
    }

    public function security()
    {
        return view('profile.security');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required']);

        auth()->user()->update($request->all());

        // flash('Your Profile was updated successfully')->success();


        return back();

    }

    public function updatePassword(Request $request)
    {
          $this->validate($request, [
              'old_password' => 'required',
              'password' => 'required|string|min:6|confirmed'
            ]);

          $old_password = $request->get('old_password');
          $password = $request->get('password');

          if(!\Hash::check($old_password, auth()->user()->password))
          {
            // flash('Please enter your current password correct!')->success();

              return back();
          }

          auth()->user()->password = bcrypt($password);
          auth()->user()->save();

           // flash('Your password was successfully updated!')->success();

          return back();
    }
}
