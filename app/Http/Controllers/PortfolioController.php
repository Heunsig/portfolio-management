<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Type;
use DateTime;

class PortfolioController extends Controller
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

    public function getPortfolios(){
    	
    	$portfolios = Portfolio::orderBy('order_number','desc')->get();
    	$result = [];
    	$i = 0;
    	foreach($portfolios as $portfolio){
            $image = $portfolio->select_frist_file();

            $result[$i]['id']         = $portfolio->id;
            $result[$i]['name']       = $portfolio->name;
            $result[$i]['created_at'] = date_format($portfolio->created_at,'m/d/Y');
            $result[$i]['updated_at'] = date_format($portfolio->updated_at,'m/d/Y');

            
            $updated_at = new DateTime($portfolio->updated_at);
            $current    = new DateTime();
            $diff       = date_diff($current, $updated_at);

            if($diff->days < 3){
                $result[$i]['bool_newest'] = TRUE;
            }

            //$restul[$i]['uup'] = $portfolio->updated_at;

            if($image){
                $result[$i]['thumbnail']['id']         = $image->id;
                $result[$i]['thumbnail']['saved_dir']  = $image->saved_dir;
                $result[$i]['thumbnail']['saved_name'] = $image->saved_name;
            }
    		$j = 0;
    		foreach($portfolio->types as $type){
    			$result[$i]['types'][$j]['name'] = 	$type->name;
                $result[$i]['types'][$j]['code'] =  $type->code;
    			$j++;
    		}
    		
    		$i++;
    	}

    	return response(json_encode($result),200)->header('Content-Type', 'application/json');
    }
}
