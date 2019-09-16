<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Portfolio;
use App\Models\Admin\File;
use App\Models\Admin\AlternativeImage;
use App\Models\Admin\Category;
use App\Models\Admin\Icon;
use App\Helpers\FileManager;
use Session;
use Image;
use Storage;

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
                    $this->uploadFiles($image, $portfolio);
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

        return redirect()->route('admin.portfolios.show', $portfolio->id);
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
        $portfolio->explanation = nl2br(strip_tags(preg_replace('/\[(.[^\[\]\(\)]+)\]\((.[^\[\]\(\)]+)\)/uim', '<a href="${2}" target="__blank">${1}</a>', $portfolio->explanation), '<a>'));

        return view('admin.portfolio.show')->with([
            'portfolio' => $portfolio
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
                    $this->uploadFiles($image, $portfolio);
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

        return redirect()->route('admin.portfolios.edit', $id);
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

        return redirect()->route('admin.portfolios.index');
    }

    
    public function resortImages(Request $request, $id)
    {
        $portfolio = Portfolio::find($id);
        $resortedIds = $request->sortedIds;

        $order = 1;
        foreach($resortedIds as $imageId){
            $portfolio->files()->updateExistingPivot($imageId, ['order_number' => $order]);
            $order++;
        }

        return response()->json(['success' => 'Successfully images were resorted.']);
    }

    private function uploadFiles($image, $portfolio)
    {
        $fileManager = new FileManager($image, '', 'local', true);
        $fileManager->edit(function($file){
            $img = Image::make($file);

            if ($img->width() > 1200) {
                $img->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            return $img->stream()->__toString();
        });


        $result = $fileManager->upload();

        $fileManagerThumb = new FileManager($image, 'thumbnail', 'local', true);
        $fileManagerThumb->edit(function($file){
            $img = Image::make($file);

            if ($img->width() > 90) {
                $img->resize(90, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            return $img->stream()->__toString();
        });
        $resultThumb = $fileManagerThumb->upload();

        $fileManagerThumb2 = new FileManager($image, 'thumbnail', 'local', true);
        $fileManagerThumb2->edit(function($file){
            $img = Image::make($file);

            if ($img->width() > 300) {
                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            return $img->stream()->__toString();
        });
        $resultThumb2 = $fileManagerThumb2->upload();

        $newFile = new File;
        $newFile->storage = $result['uploaded_file_information']['storage'];
        $newFile->mime      = $result['uploaded_file_information']['mime'];
        $newFile->saved_dir = $result['uploaded_file_information']['directory'];
        $newFile->orig_name = $result['uploaded_file_information']['original_filename'];
        $newFile->saved_name= $result['uploaded_file_information']['filename'];
        $newFile->size      = $result['uploaded_file_information']['filesize'];
        $newFile->is_image  = true;
        $newFile->save();

        $newFile->alternative_images()->saveMany([
            new AlternativeImage([
                'size'=> '90x',
                'saved_dir' => $resultThumb['uploaded_file_information']['directory']
            ]),
            new AlternativeImage([
                'size'=> '300x',
                'saved_dir' => $resultThumb2['uploaded_file_information']['directory']
            ]),
        ]);

        $last_portfolio = Portfolio::find($portfolio->id);
        $portfolio->files()->attach([$newFile->id =>['order_number'=>$last_portfolio->files()->count() + 1]]);
    }
}
