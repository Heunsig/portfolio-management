<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Content;
use App\Http\Controllers\API\helpers\Converter;

class ContentController extends Controller
{
    public function getContents (Request $request) {
        $contents = Content::all();
        $result = [];

        foreach ($contents as $content) {
            $result[] = Converter::makeResult($content, $request->query('only'));
        }

        return response()->json($result);
    }

    public function getContent (Request $request, $id) {
        $content = Content::where('id', $id)->first();
        return response()->json(Converter::makeResult($content, $request->query('only')));
    }
}
