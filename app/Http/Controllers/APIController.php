<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Content;
use App\Models\Admin\Portfolio;
use App\Models\Admin\PictureRoom;

class APIController extends Controller
{
    public function getContents (Request $request) {
        $contents = Content::all();
        $result = [];

        foreach ($contents as $content) {
            $result[] = $this->makeResult($content, $request->query('only'));
        }

        return response()->json($result);
    }

    public function getContent (Request $request, $id) {
        $content = Content::where('id', $id)->first();
        return response()->json($this->makeResult($content, $request->query('only')));
    }

    public function getPortfolios (Request $request) {
        $portfolios = Portfolio::with('links', 'files')->get();
        $result = [];

        foreach ($portfolios as $portfolio) {
            $result[] = $this->makeResult($portfolio, $request->query('only'));
        }

        return response()->json($result);
    }

    public function getPortfolio (Request $request, $id) {
        $portfolio = Portfolio::where('id', $id)->with('links', 'files')->first();
        return response()->json($this->makeResult($portfolio, $request->query('only')));
    }


    public function getPictureRoomById (Request $request, $id) {
        $pictureRoom = PictureRoom::where('id', $id)->with('pictures')->first();
        return response()->json($this->makeResult($pictureRoom, $request->query('only')));
    }

    public function getPictureRoomByCode (Request $request, $code) {
        $pictureRoom = PictureRoom::where('code', $code)->with('pictures')->first();
        return response()->json($this->makeResult($pictureRoom, $request->query('only')));
    }

    private function hasProperty ($object, $property) {
        foreach ($object as $key => $value) {
            if ($key == $property) {
                return true;
            }
        }

        return false;
    }

    private function filterProperty ($elements, $value) {
        $result = [];
        foreach($elements as $element) {
            if ($this->hasProperty($value, $element)) {
                $result[$element] = $value[$element];
            }
        }

        return $result;
    }

    private function makeResult ($value, $onlyQuery) {
        $result = [];

        if ($value) {
            $value = $value->toArray();

            if ($onlyQuery) {
                $elementsToFilter = explode(',', $onlyQuery);

                $result = $this->filterProperty($elementsToFilter, $value);
            } else {
                $result = $value;
            }
        }


        return $result;
    } 
}
