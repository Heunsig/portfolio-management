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

// Page Routes
Route::group(['prefix'=>'page'], function(){
	Route::get('portfolio', 'PageController@getPortfolio');
	Route::get('template', 'PageController@getTemplate');
	Route::get('contact', 'PageController@getContact');	
	Route::get('portfolioPop/{id}', 'PageController@getPortfolioPop');
	Route::get('templatePop/{id}', 'PageController@getTemplatePop');
});
	
Route::group(['prefix'=>'get'], function(){
	Route::get('portfolios', 'PortfolioController@getPortfolios');
	Route::get('templates', 'TemplateController@getTemplates');
	Route::get('categories', 'PortfolioController@getCategories');
});

// Transfer Route
Route::get('transfer', 'TransferController@moveToLink')->name('transfer');
