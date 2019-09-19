<?php

use Illuminate\Http\Request;
use App\Models\Admin\Content;
use App\Models\Admin\Portfolio;
use App\Models\Admin\PictureRoom;
// use Response;

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


// Route::middleware(['cors', 'checkReferrer', 'dbConn.api'])->group(function () {
Route::middleware(['cors'])->group(function () {
    Route::get('contents', 'APIController@getContents');
    Route::get('contents/{id}', 'APIController@getContent');

    Route::get('portfolios', 'APIController@getPortfolios');
    Route::get('portfolios/{id}', 'APIController@getPortfolio');
    
    Route::get('pictureRooms/{id}', 'APIController@getPictureRoomById');
    Route::get('pictureRooms/code/{code}', 'APIController@getPictureRoomByCode');
});
