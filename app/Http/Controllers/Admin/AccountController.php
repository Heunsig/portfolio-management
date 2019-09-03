<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Hash;
use Session;
use Illuminate\Support\MessageBag;

class AccountController extends Controller
{
    public function index()
    {
        return view('admin.account.index')->with([
          'email' => Auth::user()->email
        ]);
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, array(
            "password" =>' required',
            "newPassword" =>' required|confirmed'
        ));

        $errors = new MessageBag();

        if (Hash::check($request->password, Auth::user()->password)) {
            Auth::user()->fill([
                'password' => Hash::make($request->newPassword)
            ])->save();

            Session::flash('success', 'Successfully changed your password.');
        } else {
            $errors->add('Unauthenticated password', 'Incorrect password');
        }

        return redirect()->route('admin.account.index')->with([
            'errors' => $errors
        ]);
        
    }
}
