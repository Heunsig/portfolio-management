<?php

use Illuminate\Http\Request;

// Admin Routes
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {

    Route::get('login', 'Auth\LoginController@index')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');

    Route::middleware(['auth', 'dbConn'])->group(function () {
        Route::get('/', 'PageController@getIndex')->name('main');
        Route::resource('content', 'ContentController');
        Route::resource('portfolio', 'PortfolioController');

        Route::resource('message', 'MessageController', [
            'except' => [
                'create',
                'edit',
                'update'
            ]
        ]);

        Route::resource('category', 'CategoryController', [
            'except' => 'create'
        ]);

        Route::resource('icon', 'IconController', [
            'except' => 'create'
        ]);


        Route::put('relocateImageOrder/{type}/{id}', 'FunctionController@relocateImageOrder');
        Route::put('relocateListOrder/{type}', 'FunctionController@relocateListOrder');

        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    });

    Route::namespace('Manager')->middleware(['auth'])->group(function () {
        Route::resource('account/apikeys', 'APIKeyController', ['as' => 'account']);

        Route::get('account/overview', 'AccountController@index')->name('account.index');
        Route::get('account/security', 'AccountController@security')->name('account.security');
        Route::post('account/changePassword', 'AccountController@changePassword')->name('account.changePassword');
    });

});
