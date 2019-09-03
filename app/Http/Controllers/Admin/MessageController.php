<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Models\Admin\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::orderBy('id','desc')->paginate(30);

        return view('admin.message.index')->with([
            'messages' => $messages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' =>'required|email|max:40'
        ]);

        $message = new Message();

        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;

        $message->save();

        Session::flash('success','Your message was successfully sent.');
        return redirect('/page/contact');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);

        return view('admin.message.show')->with([
            'message' => $message
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        Session::flash('success', 'The message was successfully deleted.');

        return redirect()->route('admin.message.index');

    }
}
