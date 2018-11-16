<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::get('/user', 'AuthController@user');
Route::post('/logout', 'AuthController@logout');

// workspace
Route::group(['prefix' => 'workspaces'], function() {
    Route::post('/', 'WorkspaceController@store')->middleware('auth:api');
    Route::get('/', 'WorkspaceController@index')->middleware('auth:api');
    Route::get('/{workspace}', 'WorkspaceController@show')->middleware('auth:api');
    Route::patch('/{workspace}', 'WorkspaceController@update')->middleware('auth:api');

    // チャンネルルート
    Route::group(['prefix' => '/{workspace}/channels'], function() {
        Route::get('/{channel}', 'ChannelController@show')->middleware('auth:api');
        Route::post('/', 'ChannelController@store')->middleware('auth:api');

        // メッセージ投稿
        Route::group(['prefix' => '/{channel}/messages'], function() {
//            Route::get('/', 'MessageController@indexInChannel')->middleware('auth:api');
            Route::post('/', 'MessageController@storeToChannel')->middleware('auth:api');
            Route::patch('/{message}', 'MessageController@update')->middleware('auth:api');
            Route::delete('/{message}', 'MessageController@destroy')->middleware('auth:api');

            // メッセージに対するスターの付け外し
            Route::post('/{message}/change_star', 'StarController@changeStar')->middleware('auth:api');
        });
    });

    // ユーザールート(todo: messsagesテーブルを変えないと、、、)
    Route::group(['prefix' => '/{workspace}/users'], function() {
        // ユーザーの一覧表示などの機能あるなら、routeを追加すればよい

        // メッセージ投稿
        Route::group(['prefix' => '/{user}/messages'], function() {
            Route::post('/', 'MessageController@storeToDM')->middleware('auth:api');
            Route::get('/', 'MessageController@indexInDM')->middleware('auth:api');
        });
    });
});