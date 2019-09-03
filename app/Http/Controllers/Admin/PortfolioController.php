<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Portfolio;
use App\Models\Admin\File;
use App\Models\Admin\Category;
use App\Models\Admin\Icon;
use Session;
use App\Helpers\FileInfo;
use App\Helpers\FileString;
use Image;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::orderBy('order_number','desc')->paginate(50);
        return view('admin.portfolio.index')->withPortfolios($portfolios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        $icons = Icon::all();

        $category_options = [];
        $icon_options = [];

        foreach($categories as $category){
            $category_options[$category->id] = $category->name;
        }

        foreach($icons as $icon){
            $icon_options[$icon->id] = $icon->name;
        }

        return view('admin.portfolio.create')->withCategories($category_options)->withIcons($icon_options);
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
            'images[]' =>'image',
        ]);

        $portfolio = new Portfolio;
        $portfolio->name        = $request->name;
        $portfolio->explanation = $request->explanation;
        $portfolio->order_number= DB::table('portfolios')->max('order_number') + 1;

        $portfolio->save();

        if ($request->hasFile('images')) {
            $images = $request->images;

            foreach ($images as $image) {
                if ($image->isValid()){
                    $file = new File;
                    $fileInfo = (new FileInfo($image))->get_fileinfo();
                    
                    $image_big = Image::make($image);
                    $image_thumb = Image::make($image);

                    // Resize a image within width 1200px
                    if ($image_big->width() > 1200) {
                        $image_big->resize(1200, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    // Resize a image for thumbnail.
                    if ($image_thumb->width() > 300) {
                        $image_thumb->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    $basePath = 'images/';
                    $path = $basePath.$fileInfo['unique_name'];
                    $path_thumbnail = $basePath.'thumbnail/'.$fileInfo['unique_name'];

                    Storage::disk('s3')->put($path, $image_big->stream()->__toString());
                    Storage::disk('s3')->put($path_thumbnail, $image_thumb->stream()->__toString());

                    $file->mime      = $fileInfo['mime'];
                    $file->saved_dir = $path;
                    $file->thumbnail_dir = $path_thumbnail;
                    $file->orig_name = $fileInfo['orig_name'];
                    $file->saved_name= $fileInfo['unique_name'];
                    $file->raw_name  = $fileInfo['raw_name'];
                    $file->extension = $fileInfo['extension'];
                    $file->size      = $fileInfo['size'];
                    $file->is_image  = true;

                    $file->save();

                    $last_portfolio = Portfolio::find($portfolio->id);
                    $portfolio->files()->attach([$file->id =>['order_number'=>$last_portfolio->files()->count() + 1]]);
                }
            }
        }

        // Filter links
        $filteredLinks = [];
        foreach($request->links as $link) {
            if ($link['link']) {
                $filteredLinks[] = $link;
            }
        }

        $portfolio->links()->createMany($filteredLinks);
        $portfolio->categories()->sync($request->categories, false);
        $portfolio->icons()->sync($request->icons, false);

        Session::flash('success', 'Successfully created a new portfolio.');

        return redirect()->route('admin.portfolio.show', $portfolio->id);
    }
    
       

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolio = Portfolio::find($id);
        return view('admin.portfolio.show')->withPortfolio($portfolio);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $portfolio = Portfolio::find($id);

        $categories = Category::all();
        $icons = Icon::all();

        $category_options = [];
        $icon_options = [];

        $selected_categories = [];
        $selected_icons = [];

        foreach($categories as $category){
            $category_options[$category->id] = $category->name;
        }

        foreach($icons as $icon){
            $icon_options[$icon->id] = $icon->name;
        }

        foreach($portfolio->categories as $category){
            $selected_categories[] = strval($category->id);
        }

        foreach($portfolio->icons as $icon){
            $selected_icons[] = strval($icon->id);
        }

        return view("admin.portfolio.edit")->with([
            "portfolio" => $portfolio,
            "categories" => $category_options,
            "icons" => $icon_options,
            "selected_categories" => $selected_categories,
            "selected_icons" => $selected_icons
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
            'name' => 'required|max:255',
            'images[]' => 'image'
        ]);

        
        $portfolio = Portfolio::find($id);
        $file = null;
        $file_info = [];
        $files_id = [];

        $portfolio->name = $request->name;
        $portfolio->explanation = $request->explanation;

        $portfolio->save();

        if ($request->hasFile('images')) {
            $images = $request->images;

            foreach ($images as $image) {
                if ($image->isValid()){
                    $file = new File;
                    $fileInfo = (new FileInfo($image))->get_fileinfo();
                    
                    $image_big = Image::make($image);
                    $image_thumb = Image::make($image);

                    // Resize a image within width 1200px
                    if ($image_big->width() > 1200) {
                        // $image = $image->resize(1200, null, function ($constraint) {
                        $image_big->resize(1200, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    // Resize a image for thumbnail.
                    if ($image_thumb->width() > 300) {
                        $image_thumb->resize(300, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                    }

                    $basePath = 'images/';
                    $path = $basePath.$fileInfo['unique_name'];
                    $path_thumbnail = $basePath.'thumbnail/'.$fileInfo['unique_name'];

                    Storage::disk('s3')->put($path, $image_big->stream()->__toString());
                    Storage::disk('s3')->put($path_thumbnail, $image_thumb->stream()->__toString());

                    $file->mime      = $fileInfo['mime'];
                    $file->saved_dir = $path;
                    $file->thumbnail_dir = $path_thumbnail;
                    $file->orig_name = $fileInfo['orig_name'];
                    $file->saved_name= $fileInfo['unique_name'];
                    $file->raw_name  = $fileInfo['raw_name'];
                    $file->extension = $fileInfo['extension'];
                    $file->size      = $fileInfo['size'];
                    $file->is_image  = true;

                    $file->save();

                    $last_portfolio = Portfolio::find($portfolio->id);
                    $portfolio->files()->attach([$file->id =>['order_number'=>$last_portfolio->files()->count() + 1]]);
                }
            }
        }

        // Filter links
        $filteredLinks = [];
        foreach($request->links as $link) {
            if ($link['link']) {
                $filteredLinks[] = $link;
            }
        }
        $portfolio->links()->delete();
        $portfolio->links()->createMany($filteredLinks);

        $portfolio->categories()->sync($request->categories);
        $portfolio->icons()->sync($request->icons);

        //  Detach Images
        if($request->has('images_to_delete')){
            $portfolio->files()->detach($request->images_to_delete);

            // Reset Images order number
            $order_number = 1;
            foreach($portfolio->files()->orderBy('order_number','asc')->get() as $file){
                $file->pivot->order_number = $order_number;
                $file->pivot->save();
                $order_number++;
            }
        }

        Session::flash('success', 'Successfully Updated this portfolio.');

        return redirect()->route('admin.portfolio.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->files()->detach();
        $portfolio->categories()->detach();
        $portfolio->icons()->detach();

        $portfolio->delete();

        // Reset list order number
        $order_number = 1;
        foreach(Portfolio::orderBy('order_number','asc')->get() as $portfolio){
            $portfolio->order_number = $order_number;
            $portfolio->save();
            $order_number++;
        }

        Session::flash('success', 'Successfully deleted the portfolio(#'.$id.').');

        return redirect()->route('admin.portfolio.index');
    }

}
