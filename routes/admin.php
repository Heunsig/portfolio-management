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

        Route::get('account', 'AccountController@index')->name('account.index');
        Route::post('changePassword', 'AccountController@changePassword')->name('account.changePassword');

        Route::put('relocateImageOrder/{type}/{id}', 'FunctionController@relocateImageOrder');
        Route::put('relocateListOrder/{type}', 'FunctionController@relocateListOrder');

        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    });

});

