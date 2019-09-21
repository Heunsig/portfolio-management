<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Icon;
use App\Http\Controllers\API\helpers\Converter;

class IconController extends Controller
{
    public function getIcons (Request $request) {
        $icons = Icon::all();
        $result = [];

        foreach ($icons as $icon) {
            $result[] = Converter::makeResult($icon, $request->query('only'));
        }

        return response()->json($result);
    }

    public function getIcon (Request $request, $id) {
        $icon = Icon::where('id', $id)->first();
        return response()->json(Converter::makeResult($icon, $request->query('only')));
    }

    public function getIconByName (Request $request, $name) {
        $icon = Icon::where('name', $name)->first();
        return response()->json(Converter::makeResult($icon, $request->query('only')));
    }
}
