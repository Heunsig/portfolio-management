<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type;
use Session;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::orderBy('id','desc')->paginate(30);
        return view('admin.types.index')->withTypes($types);
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
            "name" =>' unique:types,name|required|min:1|max:255|alpha_dash',
            "code" =>' unique:types,code|required|min:1|max:255|alpha_dash'
        ));

        $type = new Type();

        $type->name = $request->name;
        $type->code = $request->code;

        $type->save();

        Session::flash('success', 'Successfully a new type has been added.');

        return redirect()->route('admin.type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $type = Type::find($id);
        return view('admin.types.show')->with([
            'type' => $type
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
        $type = Type::find($id);
        return view('admin.types.edit')->with([
            'type' => $type
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
            "name" =>' unique:types,name,'.$id.'|required|min:1|max:255|alpha_dash',
            "code" =>' unique:types,code,'.$id.'|required|min:1|max:255|alpha_dash'
        ));

        $type = Type::find($id);

        $type->name = $request->name;
        $type->code = $request->code;

        $type->save();

        Session::flash('success', 'The type name was successfully changed');

        return redirect()->route('admin.type.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Type::find($id);

        $type->portfolios()->detach();

        $type->delete();

        Session::flash('success', 'The type was successfully deleted.');

        return redirect()->route('admin.type.index');

    }
}
