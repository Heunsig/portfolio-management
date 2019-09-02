<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id','desc')->paginate(30);
        return view('admin.category.index')->withCategories($categories);
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
            "name" =>' unique:categories,name|required|min:1|max:255|alpha_dash',
            "code" =>' unique:categories,code|required|min:1|max:255|alpha_dash'
        ));

        $category = new Category();

        $category->name = $request->name;
        $category->code = $request->code;

        $category->save();

        Session::flash('success', 'Successfully a new category has been added.');

        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.show')->with([
            'category' => $category
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
        $category = Category::find($id);
        return view('admin.category.edit')->with([
            'category' => $category
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
            "name" =>' unique:categories,name,'.$id.'|required|min:1|max:255|alpha_dash',
            "code" =>' unique:categories,code,'.$id.'|required|min:1|max:255|alpha_dash'
        ));

        $category = Category::find($id);

        $category->name = $request->name;
        $category->code = $request->code;

        $category->save();

        Session::flash('success', 'The category name was successfully changed');

        return redirect()->route('admin.category.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->portfolios()->detach();

        $category->delete();

        Session::flash('success', 'The category was successfully deleted.');

        return redirect()->route('admin.category.index');

    }
}
