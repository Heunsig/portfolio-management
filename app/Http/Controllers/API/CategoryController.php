<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Http\Controllers\API\helpers\Converter;

class CategoryController extends Controller
{
    public function getCategories (Request $request) {
        $categories = Category::all();
        $result = [];

        foreach ($categories as $category) {
            $result[] = Converter::makeResult($category, $request->query('only'));
        }

        return response()->json($result);
    }

    public function getCategory (Request $request, $id) {
        $category = Category::where('id', $id)->first();
        return response()->json(Converter::makeResult($category, $request->query('only')));
    }

    public function getCategoryByName (Request $request, $name) {
        $category = Category::where('name', $name)->first();
        return response()->json(Converter::makeResult($category, $request->query('only')));
    }

    public function getCategoryByCode (Request $request, $code) {
        $category = Category::where('code', $code)->first();
        return response()->json(Converter::makeResult($category, $request->query('only')));
    }
}
