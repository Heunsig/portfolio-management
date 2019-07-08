<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Type;

class TemplateController extends Controller
{
    public function getTypes(){
        $types = Type::all();
        $result = [];

        $i = 0;
        foreach($types as $type){

            $result[$i]['name'] = $type->name;
            $result[$i]['code'] = "." . $type->code;
            $i++;
        }

        return response(json_encode($result), 200)->header('Content-Type', 'application/json');
    }

    public function getTemplates(){
    	
    	$templates = template::orderBy('order_number','desc')->get();
    	$result = [];
    	$i = 0;
    	foreach($templates as $template){
            $image = $template->select_frist_file();

            $result[$i]['id'] = $template->id;
    		$result[$i]['name'] = $template->name;
            if($image){
                $result[$i]['thumbnail']['id'] = $image->id;
                $result[$i]['thumbnail']['saved_dir'] = $image->saved_dir;
                $result[$i]['thumbnail']['saved_name'] = $image->saved_name;
            }
    		$j = 0;
    		foreach($template->types as $type){
    			$result[$i]['types'][$j]['name'] = 	$type->name;
                $result[$i]['types'][$j]['code'] =  $type->code;
    			$j++;
    		}
    		
    		$i++;
    	}

    	return response(json_encode($result),200)->header('Content-Type', 'application/json');
    }
}
