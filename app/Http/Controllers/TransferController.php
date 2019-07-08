<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransferController extends Controller
{
	public function moveToLink(Request $request){
		//return view('etc.analyticstracking');
		return redirect($request->url);
	}
}
