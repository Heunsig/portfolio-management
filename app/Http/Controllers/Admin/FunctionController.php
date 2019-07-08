<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Portfolio;
use App\Models\Template;
//use App\Models\File;

class FunctionController extends Controller
{


    public function relocateListOrder(Request $request, $type){

        $sortedIds = $request->sortedIds;
        //var_dump($sortedIds);
        //exit;
        //
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
    public function relocateImageOrder(Request $request, $type, $id){
    	if($type == 'portfolio'){
    		$item = Portfolio::find($id);	
    	}elseif($type == 'template'){
    		$item = Template::find($id);
    	}else{
    		return response(json_encode(["success"=>"This type can't use"]),200)->header('Content-Type', 'application/json');
    	}

    	$sortedIds = $request->sortedIds;

    	$order = 1;
    	foreach($sortedIds as $sortedId){
    		$item->files()->updateExistingPivot($sortedId, ['order_number'=>$order]);
    		$order++;
    	}

    	return response(json_encode(['success'=>'Image was successfully relocated']),200)->header('Content-Type', 'application/json');
    }

}
