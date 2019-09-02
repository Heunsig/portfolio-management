<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\Category;

class TemplateController extends Controller
{
    public function getCategories(){
        $categories = Category::all();
        $result = [];

        $i = 0;
        foreach($categories as $category){

            $result[$i]['name'] = $category->name;
            $result[$i]['code'] = "." . $category->code;
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
    		foreach($template->categories as $category){
    			$result[$i]['categories'][$j]['name'] = 	$category->name;
                $result[$i]['categories'][$j]['code'] =  $category->code;
    			$j++;
    		}
    		
    		$i++;
    	}

    	return response(json_encode($result),200)->header('Content-Type', 'application/json');
    }
}
