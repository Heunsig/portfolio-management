<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\Icon;

use Session;

class IconController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $icons = Icon::orderBy('id','desc')->paginate(30);
        return view('admin.icons.index')->withIcons($icons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'unique:support_icons,name|required|min:1|max:255',
            'code' => 'unique:support_icons,code|required|min:1|max:255'
        ));

        $icon = new Icon();

        $icon->name = $request->name;
        $icon->code = $request->code;

        $icon->save();

        Session::flash('success', 'Successfully, New Icon has added');

        return redirect()->route('admin.icons.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $icon = Icon::find($id);

        return view('admin.icons.show')->with([
            'icon' => $icon
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $icon = Icon::find($id);

        return view('admin.icons.edit')->with([
            'icon' => $icon
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'unique:support_icons,name,'.$id.'|required|min:1|max:255',
            'code' => 'unique:support_icons,code,'.$id.'|required|min:1|max:255'
        ));

        $icon = Icon::find($id);

        $icon->name = $request->name;
        $icon->code = $request->code;

        $icon->save();

        Session::flash('success', 'This icon was successfully changed.');

        return redirect()->route('admin.icons.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $icon = Icon::find($id);

        $icon->portfolios()->detach();

        $icon->delete();

        Session::flash('success','The icon was successfully deleted.');

        return redirect()->route('admin.icons.index');
    }
}
