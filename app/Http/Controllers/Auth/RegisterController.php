<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Session;


class RegisterController extends Controller
{

	public function __construct()
    {
        $this->middleware('guest');
    }

	public function create(Request $request){

	}
}
