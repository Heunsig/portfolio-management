<?php

use Illuminate\Http\Request;
use App\Models\Admin\Content;
use App\Models\Admin\Portfolio;
use App\Models\Admin\PictureRoom;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// 

function hasProperty ($object, $property) {
    foreach ($object as $key => $value) {
        if ($key == $property) {
            return true;
        }
    }

    return false;
}

function filterProperty ($elements, $value) {
    $result = [];
    foreach($elements as $element) {
        if (hasProperty($value, $element)) {
            $result[$element] = $value[$element];
        }
    }

    return $result;
}

function makeResult ($value, $onlyQuery) {
    $result = [];

    if ($value) {
        $value = $value->toArray();

        if ($onlyQuery) {
            $elementsToFilter = explode(',', $onlyQuery);

            $result = filterProperty($elementsToFilter, $value);
        } else {
            $result = $value;
        }
    }


    return $result;
} 

// Route::middleware(['cors', 'checkReferrer', 'dbConn.api'])->group(function () {
Route::middleware(['cors'])->group(function () {

    Route::get('contents', function (Request $request) {
        $contents = Content::all();
        $result = [];

        foreach ($contents as $content) {
            $result[] = makeResult($content, $request->query('only'));
        }

        return response()->json($result);
    });

    Route::get('contents/{id}', function (Request $request, $id) {
        $content = Content::where('id', $id)->first();
        return response()->json(makeResult($content, $request->query('only')));
    });

    Route::get('portfolios', function (Request $request) {
        $portfolios = Portfolio::with('links', 'files')->get();
        $result = [];

        foreach ($portfolios as $portfolio) {
            $result[] = makeResult($portfolio, $request->query('only'));
        }

        return response()->json($result);
    });

    Route::get('portfolios/{id}', function (Request $request, $id) {
        $portfolio = Portfolio::where('id', $id)->with('links', 'files')->first();
        return response()->json(makeResult($portfolio, $request->query('only')));
    });
    

    Route::get('pictureRooms/{id}', function (Request $request, $id) {
        $pictureRoom = PictureRoom::where('id', $id)->with('pictures')->first();
        return response()->json(makeResult($pictureRoom, $request->query('only')));
    });
});
