<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@getIndex');

// Auth Routes
// Route::group([], function(){
	/*Route::post('admin/login', 'Auth\LoginController@login');
	Route::post('register', 'Auth\RegisterController@create');*/
// });

// Page Routes
Route::group(['prefix'=>'page'], function(){
	Route::get('portfolio', 'PageController@getPortfolio');
	Route::get('template', 'PageController@getTemplate');
	Route::get('contact', 'PageController@getContact');	
	Route::get('portfolioPop/{id}', 'PageController@getPortfolioPop');
	Route::get('templatePop/{id}', 'PageController@getTemplatePop');
});
	
// Admin Routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware'=>'auth'], function () {
	Route::get('/', 'PageController@getIndex');
	Route::resource('portfolio', 'PortfolioController', ['as'=>'admin']);
	// Route::resource('template', 'TemplateController', ['as'=>'admin']);
	Route::resource('message', 'MessageController', ['as'=>'admin', 'except'=>['create','edit','update']]);
	Route::resource('type', 'TypeController', ['as'=>'admin','except'=>'create']);
	Route::resource('icon', 'IconController',['as'=>'admin', 'except'=>'create']);
});

// Admin Auth Routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('login', [ 'as' => 'admin.login', 'uses' => 'Auth\LoginController@index']);
	Route::post('login', [ 'as' => 'admin.login', 'uses' => 'Auth\LoginController@login']);
	Route::get('logout', [ 'as' => 'admin.logout', 'uses' => 'Auth\LoginController@logout']);
});


Route::group(['prefix'=>'get'], function(){
	Route::get('portfolios', 'PortfolioController@getPortfolios');
	Route::get('templates', 'TemplateController@getTemplates');
	Route::get('types', 'PortfolioController@getTypes');
});

// Relocate Routes
Route::put('relocateImageOrder/{type}/{id}','Admin\FunctionController@relocateImageOrder');
Route::put('relocateListOrder/{type}', 'Admin\FunctionController@relocateListOrder');

// Transfer Route
Route::get('transfer', 'TransferController@moveToLink')->name('transfer');

// Route::get('test', function(){
// 	$date = new DateTime('2017-05-16 15:49:26');
// 	$now = new DateTime();
// 	$diff = date_diff($now, $date);
// 	var_dump($diff);
// 	if($date < $now) {
// 	echo '날짜가 이미 지났습니다';
// 	}
// });

Route::post('test', function (Request $request) {
	print_r($request->links);
})->name('test');;