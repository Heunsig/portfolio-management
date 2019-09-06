<?php

namespace App\Http\Controllers\Admin\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Manager\APIKey;
use Auth;
use Hash;
use Session;
use Illuminate\Support\MessageBag;

class AccountController extends Controller
{
    public function index()
    {
        $apikeys = APIKey::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        
        return view('admin.account.overview')->with([
          'apikeys' => $apikeys
        ]);
    }

    public function security() {
        return view('admin.account.security');
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

        return redirect()->route('admin.account.security')->with([
            'errors' => $errors
        ]);
        
    }
}
