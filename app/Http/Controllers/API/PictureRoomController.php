<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\PictureRoom;
use App\Http\Controllers\API\helpers\Converter;

class PictureRoomController extends Controller
{
    public function getPictureRoomById (Request $request, $id) {
        $pictureRoom = PictureRoom::where('id', $id)->with('pictures')->first();
        return response()->json(Converter::makeResult($pictureRoom, $request->query('only')));
    }

    public function getPictureRoomByCode (Request $request, $code) {
        $pictureRoom = PictureRoom::where('code', $code)->with('pictures')->first();
        return response()->json(Converter::makeResult($pictureRoom, $request->query('only')));
    }
}
