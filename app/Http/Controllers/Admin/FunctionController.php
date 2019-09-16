<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\Portfolio;
use App\Models\Admin\Template;
use App\Models\Admin\PictureRoom;
//use App\Models\File;

class FunctionController extends Controller
{


    public function relocateListOrder(Request $request, $type){

        $sortedIds = $request->sortedIds;
        $order = count($sortedIds);

        if($type == 'portfolio'){

            foreach($sortedIds as $sortedId){
                Portfolio::where('id',$sortedId)->update(['order_number'=>$order]);
                $order--;
            }

        }elseif($type == 'template'){

            foreach($sortedIds as $sortedId){
                Template::where('id',$sortedId)->update(['order_number'=>$order]);
                $order--;
            }

        }else{
            return response(json_encode(["success"=>"This type can't use"]),200)->header('Content-Type', 'application/json');
        }

        return response(json_encode(['success'=>'Lists was successfully relocated']),200)->header('Content-Type', 'application/json');
    
    }

	/**
     * relocate images order in post(Portfolio, Template)
     * @param  Request $request 
     * @param  [String] $type    Item type (Template or Portfolio)
     * @param  [Array]  $id      item id
     * @return response
     */
    // public function relocateImageOrder(Request $request, $type, $id){
        // $model = null;
        // $resortedIds = $request->sortedIds;

        // switch ($type) {
        //     case 'portfolio':
        //         $model = Portfolio::find($id);
        //         break;
        //     case 'pictureRoom':
        //         $model = PictureRoom::find($id);
        //         break;
        //     default: 
        //         return response()->json(['error': 'This type is not available.']);
        // }

    	// $order = 1;
    	// foreach($resortedIds as $imageId){
    	// 	$model->files()->updateExistingPivot($imageId, ['order_number'=>$order]);
    	// 	$order++;
    	// }

     //    return response()->json(['success' => 'Successfully images were resorted.']);
    // }

}
