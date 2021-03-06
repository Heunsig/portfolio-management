<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\PictureRoom;
use App\Models\Admin\File;
use App\Models\Admin\AlternativeImage;
use App\Helpers\FileManager;
use Storage;
use Image;
use Session;
use DB;


class PictureRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictureRooms = PictureRoom::all();

        return view('admin.pictureRoom.index')->with([
            'pictureRooms' => $pictureRooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pictureRoom.create');
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
            'code' => 'unique:picture_rooms,code|max:255',
            'images[]' =>'image',
        ]);


        $pictureRoom = new PictureRoom;
        $pictureRoom->title = $request->title;
        $pictureRoom->code = $request->code;
        $pictureRoom->save();
        
        if ($request->hasFile('images')){
            $images = $request->images;

            foreach($images as $image) {
                if ($image->isValid()) {
                    $this->uploadFiles($image, $pictureRoom);
                }
            }
        }

        Session::flash('success', 'Successfully created a new image.');
        return redirect()->route('admin.pictureRooms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pictureRoom = PictureRoom::find($id);
        
        return view('admin.pictureRoom.show')->with([
            'pictureRoom' => $pictureRoom
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
        $pictureRoom = PictureRoom::find($id);
        return view('admin.pictureRoom.edit')->with([
            'pictureRoom' => $pictureRoom
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
            'title' => 'required|max:255',
            'code' => "unique:picture_rooms,code,{$id}|max:255",
            'images[]' =>'image',
        ]);


        $pictureRoom = PictureRoom::find($id);

        $pictureRoom->title = $request->title;
        $pictureRoom->code = $request->code;
        $pictureRoom->save();

        if ($request->hasFile('images')){
            $images = $request->images;

            foreach($images as $image) {
                if ($image->isValid()) {
                    $this->uploadFiles($image, $pictureRoom);
                }
            }
        }

        //  Detach Images
        if($request->has('images_to_delete')){
            $pictureRoom->pictures()->detach($request->images_to_delete);

            // Reset Images order number
            $order_number = 1;
            foreach($pictureRoom->pictures()->orderBy('order_number','asc')->get() as $picture){
                $picture->pivot->order_number = $order_number;
                $picture->pivot->save();
                $order_number++;
            }
        }

        Session::flash('success', 'Successfully Updated this picture room.');

        return redirect()->route('admin.pictureRooms.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Resort images
     * @param  Request $request
     * @param  int  $id
     * @return json
     */
    public function resortImages(Request $request, $id)
    {
        $pictureRoom = PictureRoom::find($id);
        $resortedIds = $request->sortedIds;

        $order = 1;
        foreach($resortedIds as $imageId){
            $pictureRoom->pictures()->updateExistingPivot($imageId, ['order_number' => $order]);
            $order++;
        }

        return response()->json(['success' => 'Successfully images were resorted.']);
    }


    private function uploadFiles($file, $model)
    {
        $fileManager = new FileManager($file, '', 'local', true);
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

        $fileManagerThumb = new FileManager($file, 'thumbnail', 'local', true);
        $fileManagerThumb->edit(function($file){
            $img = Image::make($file);

            if ($img->width() > 300) {
                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            return $img->stream()->__toString();
        });
        $resultThumb = $fileManagerThumb->upload();


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
                'size'=> '300x',
                'saved_dir' => $resultThumb['uploaded_file_information']['directory']
            ])
        ]);

        $last_picture_room = PictureRoom::find($model->id);
        $model->pictures()->attach([
            $newFile->id => ['order_number' => $last_picture_room->pictures()->count() + 1]
        ]);
    }
}
