<?php
//////////////
// Not used //
//////////////
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Template;
use App\Models\Admin\File;
use App\Models\Admin\Category;
use App\Models\Admin\Icon;
use Session;
use App\Helpers\FileInfo;
use App\Helpers\FileString;
use Image;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::orderBy('order_number','desc')->paginate(50);

        return view('admin.template.index')->with([
            'templates' => $templates
        ]);
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

        return view('admin.template.create')->withCategories($category_options)->withIcons($icon_options);
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

        $template = new Template;
        $file = null;
        $file_info = [];
        $files_id = [];
       

        $template->name                = $request->name;
        $template->link                = $request->link;
        $template->explanation         = $request->explanation;
        $template->order_number        = DB::table('templates')->max('order_number') + 1;

        $template->save();

        if($request->hasFile('images')){

            $images = $request->file("images");

            $directory = "uploads/template/";

            foreach($images as $key => $image){
                $file = new File;

                $new_filename = FileString::raw_name($image->getClientOriginalName()) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $location = public_path($directory );

                $fileInfo = [];
                $fileInfo = new FileInfo($image);
                $file_info = $fileInfo->get_fileinfo();
                $file_info['saved_dir'] = "/". $directory;
                $file_info['saved_name'] = $new_filename;
                $file_info['download'] = 0;

                // Get width value
                $width = Image::make($image)->width();

                // Save original image
                if($width > 1200){
                    Image::make($image)->resize(1200, null, function($constraint){
                            $constraint->aspectRatio();
                    })->save($location . $new_filename, 100);
                }else{
                    Image::make($image)->save($location . $new_filename, 100);    
                }

                // Make front thumbnail image
                if($width > 300){
                    Image::make($image)->resize(300, null, function($constraint){
                            $constraint->aspectRatio();
                    })->save($location . 'thumbnail/'. $new_filename);    
                }else{
                    Image::make($image)->save($location . 'thumbnail/' . $new_filename);
                }

                $file->mime = $file_info['mime'];
                $file->saved_dir = $file_info['saved_dir'];
                $file->saved_name = $file_info['saved_name'];
                $file->orig_name = $file_info['orig_name'];
                $file->raw_name = $file_info['raw_name'];
                $file->extension = $file_info['extension'];
                $file->size = $file_info['size'];
                $file->is_image = null;
                $file->download = $file_info['download'];

                $file->save();

                $last_template = Template::find($template->id);
                $template->files()->attach([$file->id =>['order_number'=>$last_template->files()->count() + 1]]);
            }

        }

        $template->categories()->sync($request->categories, false);
        $template->icons()->sync($request->icons, false);

        Session::flash('success', 'Success Test');            

        return redirect()->route('admin.template.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::find($id);
        return view('admin.template.show')->withTemplate($template);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = Template::find($id);

        $categories = Category::all();
        $icons = Icon::all();

        $category_options = [];
        $icon_options = [];

        $had_categories = [];
        $had_icons = [];

        foreach($categories as $category){
            $category_options[$category->id] = $category->name;
        }

        foreach($icons as $icon){
            $icon_options[$icon->id] = $icon->name;
        }

        $i = 0;
        foreach($template->categories as $category){
            $had_categories[$i] = $categorie->id;
            $i++;
        }

        $i = 0;
        foreach($template->icons as $icon){
            $had_icons[$i] = $icon->id;
            $i++;
        }
        
        return view("admin.template.edit")->with([
            "template" => $template,
            "categories" => $category_options,
            "icons" => $icon_options,
            "had_categories" => $had_categories,
            "had_icons" => $had_icons
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
        $template = Template::find($id);
        $file = null;
        $file_info = [];
        $files_id = [];

        $this->validate($request, [
            'name' => 'required|max:255',
            'images[]' => 'image',
        ]);

        $template->name = $request->name;
        $template->link = $request->link;
        $template->explanation = $request->explanation;

        $template->save();

        if($request->hasFile('images')){

            $images = $request->file("images");

            $directory = "uploads/template/";

            foreach($images as $key => $image){
                $file = new File;

                $new_filename = FileString::raw_name($image->getClientOriginalName()) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $location = public_path($directory );

                $fileInfo = [];
                $fileInfo = new FileInfo($image);
                $file_info = $fileInfo->get_fileinfo();
                $file_info['saved_dir'] = "/". $directory;
                $file_info['saved_name'] = $new_filename;
                $file_info['download'] = 0;

                // Get width value
                $width = Image::make($image)->width();

                // Save original image
                if($width > 1200){
                    Image::make($image)->resize(1200, null, function($constraint){
                            $constraint->aspectRatio();
                    })->save($location . $new_filename, 100);
                }else{
                    Image::make($image)->save($location . $new_filename, 100);    
                }

                // Make front thumbnail image
                if($width > 300){
                    Image::make($image)->resize(300, null, function($constraint){
                            $constraint->aspectRatio();
                    })->save($location . 'thumbnail/'. $new_filename);    
                }else{
                    Image::make($image)->save($location . 'thumbnail/' . $new_filename);
                }

                $file->mime = $file_info['mime'];
                $file->saved_dir = $file_info['saved_dir'];
                $file->saved_name = $file_info['saved_name'];
                $file->orig_name = $file_info['orig_name'];
                $file->raw_name = $file_info['raw_name'];
                $file->extension = $file_info['extension'];
                $file->size = $file_info['size'];
                $file->is_image = null;
                $file->download = $file_info['download'];

                $file->save();

                $last_template = Template::find($template->id);
                $template->files()->attach([$file->id =>['order_number'=>$last_template->files()->count() + 1]]);
            }

        }

        $template->categories()->sync($request->categories);
        $template->icons()->sync($request->icons);

        //  Detach Images
        if($request->has('images_to_delete')){
            $template->files()->detach($request->images_to_delete);

            // Reset Images order number
            $order_number = 1;
            foreach($template->files()->orderBy('order_number','asc')->get() as $file){
                $file->pivot->order_number = $order_number;
                $file->pivot->save();
                $order_number++;
            }
        }

        Session::flash('success', 'Successfully Updated');

        return redirect()->route('admin.template.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::find($id);
        $template->files()->detach();
        $template->categories()->detach();
        $template->icons()->detach();

        $template->delete();

        // Reset list order number
        $order_number = 1;
        foreach(Template::orderBy('order_number','asc')->get() as $template){
            $template->order_number = $order_number;
            $template->save();
            $order_number++;
        }

        Session::flash('success', 'The template was successfully deleted.');

        return redirect()->route('admin.template.index');
    }
}
