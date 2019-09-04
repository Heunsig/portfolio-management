<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Session;

class LoginController extends Controller
{
    public function index(){
    	return view('admin.auth.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email,'password'=>$request->password])) {
            return redirect()->route('admin.main');
        }else{
        	Session::flash('fail','ID or Password was wrong.');
        	return redirect()->back();
        }
    }

    public function logout(){
    	Auth::logout();
    	return redirect('/admin');
    }
}
