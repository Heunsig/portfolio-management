<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Content;
use Session;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contents = Content::all();
        return view('admin.content.index')->with([
            'contents' => $contents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.create');
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
            'title' => 'required|max:255',
        ]);

        $content = new Content;
        $content->title = $request->title;
        $content->subtitle = $request->subtitle;
        $content->content = $request->content;
        $content->save();

        Session::flash('success', 'Successfully created a new content.');            

        return redirect()->route('admin.content.show', $content->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $content = Content::find($id);
        // This regexp includes a method which can set <a>'s option.
        // \[(.[^\[\]\(\)]+)\]\((.[^\[\]\(\)]+)\)(\((.[^\[\]\(\)]+)\))? 
        $content->content = nl2br(strip_tags(preg_replace('/\[(.[^\[\]\(\)]+)\]\((.[^\[\]\(\)]+)\)/uim', '<a href="${2}" target="__blank">${1}</a>', $content->content), '<a>'));

        return view('admin.content.show')->with([
            'content' => $content
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
        $content = Content::find($id);
        return view('admin.content.edit')->with([
            'content' => $content
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
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);

        $content = Content::find($id);
        $content->title = $request->title;
        $content->subtitle = $request->subtitle;
        $content->content = $request->content;
        $content->save();

        Session::flash('success', 'Successfully updated the content.');
        return redirect()->route('admin.content.edit', $content->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $content = Content::find($id);
        $content->delete();

        Session::flash('success', 'Successfully deleted the content(#'.$id.').');

        return redirect()->route('admin.content.index');
    }
}
