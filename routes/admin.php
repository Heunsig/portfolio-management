<?php

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

// Admin Routes
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('test', function () {
        $post = Post::find(1);
        print_r($post->tags);
    });

    Route::get('login', 'Auth\LoginController@index')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');

    Route::middleware(['auth'])->group(function () {
        Route::get('/', 'PageController@getIndex')->name('main');
        Route::resource('contents', 'ContentController');
        Route::resource('portfolios', 'PortfolioController');

        Route::resource('messages', 'MessageController', [
            'except' => [
                'create',
                'edit',
                'update'
            ]
        ]);

        Route::resource('categories', 'CategoryController', [
            'except' => 'create'
        ]);

        Route::resource('icons', 'IconController', [
            'except' => 'create'
        ]);

        Route::resource('pictureRooms', 'PictureRoomController');

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
